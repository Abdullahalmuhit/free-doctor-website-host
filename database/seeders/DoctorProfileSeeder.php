<?php
// database/seeders/DoctorProfileSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Qualification;
use App\Models\WorkExperience;
use App\Models\Certification;
use App\Models\Membership;
use App\Models\Specialization;
use App\Models\TrainingProgram;

class DoctorProfileSeeder extends Seeder
{
    public function run()
    {
        // Create Doctor User
        $doctor = User::create([
            'name' => 'Abdullah Al Muhid',
            'email' => 'dr.muhid@example.com',
            'password' => bcrypt('password'),
            'title' => 'Prof. Dr.',
            'designation' => 'Senior Consultant - Neurology',
            'phone' => '+880 1711-123456',
            'bio' => 'Dedicated neurologist with extensive experience in stroke care, headache management, and neurological disorders.',
            'about' => 'Dr. Abdullah Al Muhid is a dedicated and experienced neurologist who graduated from Bangladesh Medical College (affiliated with University of Dhaka) with MBBS in 2008. In 2009, he started his Masters (MD) in Clinical and Public Health Nutrition from University of Dhaka. He went on to pursue his higher education and training in Neurology at Holy Family Red Crescent Medical College & Hospital and Bangabandhu Sheikh Mujib Medical University (BSMMU). He is Professor of Neurology (CC) at Enam Medical College & Hospital and Senior Consultant at BRB Hospital.',
            'specialization' => 'Neurology',
            'years_of_experience' => 16,
            'medical_license_number' => 'A-12345',
            'address' => 'Dhaka, Bangladesh',
            'city' => 'Dhaka',
            'country' => 'Bangladesh',
            'is_active' => true,
            'is_accepting_patients' => true,
            'consultation_fee' => '1500',
            'follow_up_fee' => '1000',
            'role' => 'doctor',
            'languages_spoken' => ['Bengali', 'English'],
            'consultation_types' => ['In-person', 'Online Consultation'],
        ]);

        // Academic Qualifications
        $qualifications = [
            [
                'degree' => 'MD (Neurology)',
                'institution' => 'BSMMU, University of Dhaka',
                'specialization' => 'Neurology',
                'location' => 'Dhaka, Bangladesh',
                'completion_year' => 2016,
                'order' => 1,
            ],
            [
                'degree' => 'MD (CFNB)',
                'institution' => 'College of Medicine, United Kingdom',
                'specialization' => 'Clinical Nutrition',
                'location' => 'United Kingdom',
                'completion_year' => 2010,
                'order' => 2,
            ],
            [
                'degree' => 'MBBS',
                'institution' => 'Bangladesh Medical College and Hospital, University of Dhaka',
                'location' => 'Dhaka, Bangladesh',
                'start_year' => 2002,
                'completion_year' => 2008,
                'order' => 3,
            ],
        ];

        foreach ($qualifications as $qual) {
            Qualification::create(array_merge(['user_id' => $doctor->id], $qual));
        }

        // Work Experience
        $experiences = [
            [
                'position' => 'Professor of Neurology (CC)',
                'institution' => 'Enam Medical College & Hospital, Savar',
                'department' => 'Department of Neurology',
                'location' => 'Savar, Dhaka',
                'start_date' => '2023-11-01',
                'end_date' => null,
                'is_current' => true,
                'responsibilities' => 'Leading the neurology department, teaching medical students, providing specialized neurological care',
                'order' => 1,
            ],
            [
                'position' => 'Associate Professor, Neurology',
                'institution' => 'Ibn Sina Medical College and Hospital, Dhaka',
                'department' => 'Department of Neurology',
                'location' => 'Dhaka',
                'start_date' => '2023-05-01',
                'end_date' => '2023-11-01',
                'is_current' => false,
                'order' => 2,
            ],
            [
                'position' => 'Consultant Neurology',
                'institution' => 'BRB Hospital',
                'department' => 'Neurology Department',
                'location' => 'Dhaka',
                'start_date' => '2019-12-01',
                'end_date' => '2020-10-31',
                'is_current' => false,
                'order' => 3,
            ],
            [
                'position' => 'Assistant Professor, Neurology',
                'institution' => 'Ad-din Sakina Medical College',
                'department' => 'Department of Neurology',
                'location' => 'Dhaka',
                'start_date' => '2018-10-01',
                'end_date' => '2019-10-31',
                'is_current' => false,
                'order' => 4,
            ],
            [
                'position' => 'Clinical Registrar in Neurology',
                'institution' => 'Apollo Hospitals Dhaka, Shamoli, Dhaka',
                'department' => 'Neurology',
                'location' => 'Dhaka',
                'start_date' => '2016-07-01',
                'end_date' => '2018-01-31',
                'is_current' => false,
                'order' => 5,
            ],
            [
                'position' => 'Registrar, Department of Medicine',
                'institution' => 'Dhaka Shishu (Children) Hospital, Dhaka',
                'department' => 'Medicine',
                'location' => 'Dhaka',
                'start_date' => '2013-02-01',
                'end_date' => '2016-02-29',
                'is_current' => false,
                'order' => 6,
            ],
        ];

        foreach ($experiences as $exp) {
            WorkExperience::create(array_merge(['user_id' => $doctor->id], $exp));
        }

        // Training Programs
        $trainings = [
            [
                'program_name' => 'Certificate Course in Stroke (CCS) at BPKIHS',
                'institution' => 'BP Koirala Institute of Health Sciences',
                'location' => 'Nepal',
                'start_date' => '2009-01-01',
                'end_date' => '2009-12-31',
                'order' => 1,
            ],
            [
                'program_name' => 'Nursing Program in Acute Stroke Management- Pune India',
                'institution' => 'Medical Training Institute',
                'location' => 'Pune, India',
                'start_date' => '2014-01-01',
                'end_date' => '2014-12-31',
                'order' => 2,
            ],
            [
                'program_name' => 'Trained in EMG and NCS from BSMMU',
                'institution' => 'Bangabandhu Sheikh Mujib Medical University',
                'location' => 'Dhaka, Bangladesh',
                'start_date' => '2015-01-01',
                'end_date' => '2015-12-31',
                'order' => 3,
            ],
        ];

        foreach ($trainings as $training) {
            TrainingProgram::create(array_merge(['user_id' => $doctor->id], $training));
        }

        // Professional Memberships
        $memberships = [
            [
                'organization_name' => 'Electron Society of Bangladesh Physicians',
                'membership_type' => 'Member',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'organization_name' => 'American Academy of Neurology',
                'membership_type' => 'Member',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'organization_name' => 'World Stroke Organization',
                'membership_type' => 'Member',
                'is_active' => true,
                'order' => 3,
            ],
        ];

        foreach ($memberships as $membership) {
            Membership::create(array_merge(['user_id' => $doctor->id], $membership));
        }

        // Areas of Specialization
        $specializations = [
            [
                'name' => 'Stroke, Neurovascular Diseases',
                'description' => 'Expert in diagnosis and management of stroke and cerebrovascular conditions',
                'icon' => 'fas fa-brain',
                'order' => 1,
            ],
            [
                'name' => 'Epilepsy & Seizure Disorders',
                'description' => 'Specialized treatment for epilepsy and seizure-related conditions',
                'icon' => 'fas fa-bolt',
                'order' => 2,
            ],
            [
                'name' => 'Movement Disorders (Parkinson\'s)',
                'description' => 'Comprehensive care for Parkinson\'s disease and movement disorders',
                'icon' => 'fas fa-walking',
                'order' => 3,
            ],
            [
                'name' => 'Headache & Migraine Treatment',
                'description' => 'Effective management of headaches, migraines, and related pain',
                'icon' => 'fas fa-head-side-virus',
                'order' => 4,
            ],
            [
                'name' => 'Dementia & Memory Disorders',
                'description' => 'Expert care for dementia, Alzheimer\'s, and memory-related issues',
                'icon' => 'fas fa-user-md',
                'order' => 5,
            ],
            [
                'name' => 'Neuropathic Diseases',
                'description' => 'Treatment of nerve damage and neuropathic conditions',
                'icon' => 'fas fa-notes-medical',
                'order' => 6,
            ],
            [
                'name' => 'Multiple Sclerosis',
                'description' => 'Comprehensive management of Multiple Sclerosis',
                'icon' => 'fas fa-disease',
                'order' => 7,
            ],
            [
                'name' => 'Neuropathy Management',
                'description' => 'Expert treatment for peripheral and diabetic neuropathy',
                'icon' => 'fas fa-hand-holding-medical',
                'order' => 8,
            ],
        ];

        foreach ($specializations as $spec) {
            Specialization::create(array_merge(['user_id' => $doctor->id], $spec));
        }
    }
}
