<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Qualification;
use App\Models\WorkExperience;
use App\Models\Certification;
use App\Models\Membership;
use App\Models\Specialization;
use App\Models\Award;
use App\Models\TrainingProgram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDoctorProfileController extends Controller
{
    // Show doctor profile management
    public function index()
    {
        $doctor = User::doctors()
            ->with([
                'qualifications',
                'workExperiences',
                'certifications',
                'memberships',
                'specializations',
                'awards',
                'trainingPrograms'
            ])
            ->first();

        return view('admin.doctor-profile.index', compact('doctor'));
    }

    // Update basic information with image upload
    public function updateBasicInfo(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'title' => 'required|string',
            'designation' => 'required|string',
            'phone' => 'nullable|string',
            'bio' => 'nullable|string',
            'about' => 'nullable|string',
            'specialization' => 'nullable|string',
            'years_of_experience' => 'nullable|integer',
            'profile_photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048', // 2MB max
            'consultation_fee' => 'nullable|string',
            'follow_up_fee' => 'nullable|string',
            'languages_spoken' => 'nullable|array',
            'consultation_types' => 'nullable|array',
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($doctor->profile_photo && Storage::disk('public')->exists($doctor->profile_photo)) {
                Storage::disk('public')->delete($doctor->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('doctors', 'public');
            $validated['profile_photo'] = $path;
        }

        $doctor->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    // Qualifications Management
    public function storeQualification(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'degree' => 'required|string',
            'institution' => 'required|string',
            'specialization' => 'nullable|string',
            'location' => 'nullable|string',
            'start_year' => 'nullable|integer',
            'completion_year' => 'required|integer',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        // Handle certificate upload
        if ($request->hasFile('certificate_file')) {
            $validated['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }

        $doctor->qualifications()->create($validated);

        return back()->with('success', 'Qualification added successfully.');
    }

    public function updateQualification(Request $request, Qualification $qualification)
    {
        $validated = $request->validate([
            'degree' => 'required|string',
            'institution' => 'required|string',
            'specialization' => 'nullable|string',
            'location' => 'nullable|string',
            'start_year' => 'nullable|integer',
            'completion_year' => 'required|integer',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle certificate upload
        if ($request->hasFile('certificate_file')) {
            // Delete old file
            if ($qualification->certificate_file && Storage::disk('public')->exists($qualification->certificate_file)) {
                Storage::disk('public')->delete($qualification->certificate_file);
            }
            $validated['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }

        $qualification->update($validated);

        return back()->with('success', 'Qualification updated successfully.');
    }

    public function destroyQualification(Qualification $qualification)
    {
        // Delete certificate file if exists
        if ($qualification->certificate_file && Storage::disk('public')->exists($qualification->certificate_file)) {
            Storage::disk('public')->delete($qualification->certificate_file);
        }

        $qualification->delete();
        return back()->with('success', 'Qualification deleted successfully.');
    }

    // Work Experience Management
    public function storeExperience(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'position' => 'required|string',
            'institution' => 'required|string',
            'department' => 'nullable|string',
            'location' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'responsibilities' => 'nullable|string',
            'achievements' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->has('is_current');

        $doctor->workExperiences()->create($validated);

        return back()->with('success', 'Work experience added successfully.');
    }

    public function updateExperience(Request $request, WorkExperience $experience)
    {
        $validated = $request->validate([
            'position' => 'required|string',
            'institution' => 'required|string',
            'department' => 'nullable|string',
            'location' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'responsibilities' => 'nullable|string',
            'achievements' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->has('is_current');

        $experience->update($validated);

        return back()->with('success', 'Work experience updated successfully.');
    }

    public function destroyExperience(WorkExperience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Work experience deleted successfully.');
    }

    // Specialization Management
    public function storeSpecialization(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $doctor->specializations()->create($validated);

        return back()->with('success', 'Specialization added successfully.');
    }

    public function updateSpecialization(Request $request, Specialization $specialization)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string',
            'order' => 'nullable|integer',
        ]);

        $specialization->update($validated);

        return back()->with('success', 'Specialization updated successfully.');
    }

    public function destroySpecialization(Specialization $specialization)
    {
        $specialization->delete();
        return back()->with('success', 'Specialization deleted successfully.');
    }

    // Membership Management
    public function storeMembership(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'organization_name' => 'required|string',
            'membership_type' => 'nullable|string',
            'membership_id' => 'nullable|string',
            'start_date' => 'nullable|date',
            'order' => 'nullable|integer',
        ]);

        $doctor->memberships()->create($validated);

        return back()->with('success', 'Membership added successfully.');
    }

    public function updateMembership(Request $request, Membership $membership)
    {
        $validated = $request->validate([
            'organization_name' => 'required|string',
            'membership_type' => 'nullable|string',
            'membership_id' => 'nullable|string',
            'start_date' => 'nullable|date',
            'order' => 'nullable|integer',
        ]);

        $membership->update($validated);

        return back()->with('success', 'Membership updated successfully.');
    }

    public function destroyMembership(Membership $membership)
    {
        $membership->delete();
        return back()->with('success', 'Membership deleted successfully.');
    }

    // Training Program Management
    public function storeTraining(Request $request, User $doctor)
    {
        $validated = $request->validate([
            'program_name' => 'required|string',
            'institution' => 'required|string',
            'location' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle certificate upload
        if ($request->hasFile('certificate_file')) {
            $validated['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }

        $doctor->trainingPrograms()->create($validated);

        return back()->with('success', 'Training program added successfully.');
    }

    public function updateTraining(Request $request, TrainingProgram $training)
    {
        $validated = $request->validate([
            'program_name' => 'required|string',
            'institution' => 'required|string',
            'location' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
            'order' => 'nullable|integer',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        // Handle certificate upload
        if ($request->hasFile('certificate_file')) {
            // Delete old file
            if ($training->certificate_file && Storage::disk('public')->exists($training->certificate_file)) {
                Storage::disk('public')->delete($training->certificate_file);
            }
            $validated['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }

        $training->update($validated);

        return back()->with('success', 'Training program updated successfully.');
    }

    public function destroyTraining(TrainingProgram $training)
    {
        // Delete certificate file if exists
        if ($training->certificate_file && Storage::disk('public')->exists($training->certificate_file)) {
            Storage::disk('public')->delete($training->certificate_file);
        }

        $training->delete();
        return back()->with('success', 'Training program deleted successfully.');
    }
}
