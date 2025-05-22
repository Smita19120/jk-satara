<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\Trainer;
use App\Models\Branch;
use App\Models\SubBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function Login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('/dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    public function Dashboard()
    {
        if (!Auth::user()) {
            return redirect()->route('admin.index');
        }

        return view('admin.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin');
    }

    //////////////////////Slider Controllers///////////////////////////

    public function add_Slider()
    {
        $sliders = Slider::all();
        return view('admin.addSlider', compact('sliders'));
    }

    public function add_Slider_Post(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:80',
            'description' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (str_word_count($value) > 30) {
                        $fail('The ' . $attribute . ' must not be more than 30 words.');
                    }
                }
            ],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider_img = $request->file('image');
        $extension = $slider_img->getClientOriginalExtension();
        $name = time() . "sliders." . $extension;
        $destinationPath = public_path() . '/uploads/slider_images/';
        $slider_img->move($destinationPath, $name);
        $path_new = $name;

        $slider->image = $path_new;
        $slider->save();

        return redirect()->back()->with('success', 'Added Successfully !');
    }

    public function edit_Slider($id)
    {
        $slider = Slider::find($id);
        return view('admin.editSlider', compact('slider'));
    }

    public function update_Slider(Request $request)
    {
        if ($request->has('updated_image')) {
            $request->validate([
                'title' => 'required|string|max:80',
                'description' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 30) {
                            $fail('The ' . $attribute . ' must not be more than 30 words.');
                        }
                    }
                ],
                'updated_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $slider = Slider::find($request->id);
            $filePath = public_path() . '/uploads/slider_images/' . $slider->image;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $slider_img = $request->updated_image;
            $extension = $slider_img->getClientOriginalExtension();
            $name = time() . "sliders." . $extension;
            $destinationPath = public_path() . '/uploads/slider_images/';
            $slider_img->move($destinationPath, $name);
            $path_new = $name;

            $slider->image = $path_new;
            $slider->title = $request->title;
            $slider->description = $request->description;

            $slider->update();

        } else {
            $request->validate([
                'title' => 'required|string|max:80',
                'description' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (str_word_count($value) > 30) {
                            $fail('The ' . $attribute . ' must not be more than 30 words.');
                        }
                    }
                ]
            ]);
            $slider = Slider::find($request->id);
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->update();
        }
        return redirect()->route('admin.add_slider')->with('success', 'Updated Successfully !');
    }

    public function delete_Slider($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect()->route('admin.add_slider')->with('error', 'Slider not found.');
        }

        $filePath = public_path('uploads/slider_images/' . $slider->image);

        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $slider->delete();

        return redirect()->route('admin.add_slider')->with('success', 'Deleted successfully!');
    }

    ///////////////////////Branches////////////////////////////
    // Show all branches
public function branchIndex() {
    $branches = Branch::all();
    return view('admin.branch.index', compact('branches'));
}

// Show form to create branch
public function branchCreate() {
    $branches = Branch::all(); // optional
    return view('admin.branch.create', compact('branches'));
}



// Show edit form
public function branchEdit($id) {
    $branch = Branch::findOrFail($id);
    return view('admin.branch.edit', compact('branch'));
}

// Update branch
public function branchUpdate(Request $request, $id) {
    $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string|max:255',
        'established' => 'nullable|string|max:255',
    ]);

    $branch = Branch::findOrFail($id);
    $branch->update([
        'name' => $request->name,
        'contact' => $request->contact,
        'established' => $request->established,
    ]);

    return redirect()->route('branch.index')->with('success', 'Branch updated successfully');
}


// Delete branch
public function destroy($id)
{
    $branch = Branch::findOrFail($id);
    $branch->delete();

    // Reset auto-increment if no branches left
    if (Branch::count() === 0) {
        \DB::statement('ALTER TABLE branches AUTO_INCREMENT = 1');
    }

    return redirect()->route('branch.index')
           ->with('success', 'Branch deleted successfully');
}
public function resetBranches()
{
    \DB::table('branches')->truncate();
    return redirect()->route('branch.index')->with('success', 'All branches deleted and counter reset');
}



public function branchStore(Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'contact' => 'nullable|string|max:255',
        'established' => 'nullable|string|max:255',
    ]);

    Branch::create([
        'name' => $request->name,
        'contact' => $request->contact,
        'established' => $request->established,
    ]);

    return redirect()->route('branch.index')->with('success', 'Branch added successfully');
}

/////////// sub-branch///////////
// Show all sub branches
// Show all sub branches with search functionality
public function subBranchIndex(Request $request) 
{
    $search = $request->input('search');
    
    $subBranches = SubBranch::with('branch')
        ->when($search, function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhereHas('branch', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        })
        ->paginate(10); // Adjust pagination as needed

    return view('admin.sub_branch.index', compact('subBranches'));
}

// Show create form
public function subBranchCreate() {
    $branches = Branch::all();
    return view('admin.sub_branch.create', compact('branches'));
}

// Store sub branch
public function subBranchStore(Request $request) {
    SubBranch::create([
    'branch_id' => $request->branch_id,
    'name' => $request->name,
    'contact' => $request->contact,
    'address' => $request->address,
]);

    return redirect()->route('sub_branch.index')->with('success', 'Sub Branch added');
}

// Show edit form
public function subBranchEdit($id) {
    $subBranch = SubBranch::findOrFail($id);
    $branches = Branch::all();
    return view('admin.sub_branch.edit', compact('subBranch', 'branches'));
}

// Update sub branch
public function subBranchUpdate(Request $request, $id) {
    $subBranch = SubBranch::findOrFail($id);
   $subBranch->update([
    'branch_id' => $request->branch_id,
    'name' => $request->name,
    'contact' => $request->contact,
    'address' => $request->address,
]);

    return redirect()->route('sub_branch.index')->with('success', 'Sub Branch updated');
}

// Delete sub branch
public function subBranchDestroy($id)
{
    // Start a database transaction
    \DB::beginTransaction();

    try {
        $subBranch = SubBranch::findOrFail($id);
        $subBranch->delete();

        // Get the current maximum ID
        $maxId = SubBranch::max('id') ?? 0;
        
        // Reset auto-increment only if table is empty
        if (SubBranch::count() === 0) {
            \DB::statement('ALTER TABLE sub_branches AUTO_INCREMENT = 1');
        } else {
            // Reset to next available number if table isn't empty
            \DB::statement("ALTER TABLE sub_branches AUTO_INCREMENT = " . ($maxId + 1));
        }

        \DB::commit();
        
        return redirect()->route('sub_branch.index')
               ->with('success', 'Sub-branch deleted successfully');
        
    } catch (\Exception $e) {
        \DB::rollBack();
        return redirect()->route('sub_branch.index')
               ->with('error', 'Error deleting sub-branch: ' . $e->getMessage());
    }
}



public function resetSubBranchIds()
{
    \DB::beginTransaction();
    
    try {
        // Get all sub-branches ordered by ID
        $subBranches = SubBranch::orderBy('id')->get();
        
        // Temporarily disable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Reset all IDs sequentially
        $counter = 1;
        foreach ($subBranches as $subBranch) {
            \DB::table('sub_branches')
               ->where('id', $subBranch->id)
               ->update(['id' => $counter++]);
        }
        
        // Update auto-increment value
        $newAutoIncrement = $subBranches->count() > 0 ? $counter : 1;
        \DB::statement("ALTER TABLE sub_branches AUTO_INCREMENT = $newAutoIncrement");
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        \DB::commit();
        
        return redirect()->route('sub_branch.index')
               ->with('success', 'Sub-branch IDs reset successfully');
               
    } catch (\Exception $e) {
        \DB::rollBack();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return redirect()->route('sub_branch.index')
               ->with('error', 'Error resetting IDs: ' . $e->getMessage());
    }
}

    //////////////////////Trainer Controllers///////////////////////////

    public function trainerList()
    {
        $trainers = Trainer::all();
        $trainers = Trainer::with(['branch', 'subBranch'])->get();

        return view('admin.trainer.list', compact('trainers'));
    }

    public function addTrainerForm()
{
    $branches = Branch::all();
    $subBranches = SubBranch::all();
    return view('admin.trainer.add', compact('branches', 'subBranches'));
}

    public function addTrainer()
{
    $branches = Branch::all();
    $subBranches = SubBranch::all();
    return view('admin.trainer.add', compact('branches', 'subBranches'));
}

    public function storeTrainer(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:80',
        'designation' => 'required|string|max:80',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'branch_id' => 'required|exists:branches,id',
        'sub_branch_id' => 'required|exists:sub_branches,id',
    ]);

    $trainer_img = $request->file('image');
    $extension = $trainer_img->getClientOriginalExtension();
    $name = time() . "trainer." . $extension;
    $destinationPath = public_path() . '/uploads/trainer_images/';
    $trainer_img->move($destinationPath, $name);
    $path_new = $name;

    Trainer::create([
        'name' => $request->name,
        'designation' => $request->designation,
        'image' => $path_new,
        'branch_id' => $request->branch_id,
        'sub_branch_id' => $request->sub_branch_id,
    ]);

    return redirect()->route('admin.trainer.list')->with('success', 'Trainer added successfully!');
}
    public function edit($id)
{
    $trainer = Trainer::with(['branch', 'subBranch'])->findOrFail($id);
    $branches = Branch::all();
    $subBranches = SubBranch::all();

    return view('admin.trainer.edit', compact('trainer', 'branches', 'subBranches'));
}

    
   public function updateTrainer(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:80',
        'designation' => 'required|string|max:80',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'branch_id' => 'required|exists:branches,id',
        'sub_branch_id' => 'required|exists:sub_branches,id',
    ]);

    $trainer = Trainer::findOrFail($id);
    $data = [
        'name' => $request->name,
        'designation' => $request->designation,
        'branch_id' => $request->branch_id,
        'sub_branch_id' => $request->sub_branch_id,
    ];

    if ($request->hasFile('image')) {
        // Delete old image if exists
        $filePath = public_path('uploads/trainer_images/' . $trainer->image);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $trainer_img = $request->file('image');
        $extension = $trainer_img->getClientOriginalExtension();
        $name = time() . "trainer." . $extension;
        $destinationPath = public_path() . '/uploads/trainer_images/';
        $trainer_img->move($destinationPath, $name);
        $data['image'] = $name;
    }

    $trainer->update($data);

    return redirect()->route('admin.trainer.list')->with('success', 'Trainer updated successfully!');
}

    public function deleteTrainer($id)
    {
        $trainer = Trainer::findOrFail($id);

        // Delete image if exists
        $filePath = public_path('uploads/trainer_images/' . $trainer->image);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $trainer->delete();

        return redirect()->route('admin.trainer.list')->with('success', 'Trainer deleted successfully!');
    }

    



public function create()
{
    $branches = Branch::all();
    $subBranches = SubBranch::all();
    

    return view('admin.trainer.add', compact('branches', 'subBranches'));
}
}


