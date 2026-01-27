<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Chamber;
use App\Models\LifestyleItem;
use App\Models\ResearchPaper;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Create admin user
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@muhid.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'title' => 'Mr.',
            'designation' => 'System Administrator',
        ]);

        // Seed doctor profile
        $this->call(DoctorProfileSeeder::class);

       /* User::create([
            'name' => 'Admin',
            'email' => 'admin@drmuhid.com',
            'password' => bcrypt('password'), // Change this!
        ]);*/

        // Create Chambers
        Chamber::create([
            'name' => 'BRB Hospital',
            'room_number' => 'Room 302, 3rd Floor',
            'address' => '77/A, Panthapath, Dhaka-1215',
            'phone' => '10647',
            'visiting_hours' => [
                ['day' => 'Saturday', 'time' => '6:00 PM - 9:00 PM'],
                ['day' => 'Monday', 'time' => '6:00 PM - 9:00 PM'],
                ['day' => 'Wednesday', 'time' => '6:00 PM - 9:00 PM'],
            ],
            'is_active' => true,
        ]);

        Chamber::create([
            'name' => 'IBN Sina Hospital',
            'room_number' => 'Room 1005, 10th Floor',
            'address' => 'Road 9/A, Dhanmondi, Dhaka',
            'phone' => '09610009625',
            'visiting_hours' => [
                ['day' => 'Sunday', 'time' => '5:00 PM - 8:00 PM'],
                ['day' => 'Tuesday', 'time' => '5:00 PM - 8:00 PM'],
                ['day' => 'Thursday', 'time' => '5:00 PM - 8:00 PM'],
            ],
            'is_active' => true,
        ]);

        // Create Research Papers
        ResearchPaper::create([
            'title' => 'Increasing antioxidant intake from fruits and vegetables: practical strategies for the Scottish population',
            'authors' => 'M.A. Muhid, K.L. Breen, G. Borges, A. Crozier and S. Anderson',
            'journal' => 'Journal of Human Nutrition and Dietetics, Volume 21, Issue 6',
            'publication_date' => 'December 2008',
            'volume_issue' => 'pages 539–546',
            'type' => 'article',
            'is_published' => true,
        ]);

        ResearchPaper::create([
            'title' => 'Magnetic Resonance Imaging - Based Evaluation of the Etiology of Non-traumatic Myelopathies in Bangladesh',
            'authors' => 'Muhid M.A, Islam M, Sayedur Rahman, et al.',
            'journal' => 'Journal of National Institute of Neuroscience Bangladesh',
            'publication_date' => 'July 2018',
            'volume_issue' => 'Vol 4 (02): 87-91',
            'type' => 'article',
            'is_published' => true,
        ]);

        ResearchPaper::create([
            'title' => 'Polycythemia Vera initially presenting with Acute Ischaemic Stroke: A Case Report',
            'authors' => 'Muhid A, Islam SM, Wazed S, Islam T, Ghosh CL, Ahmed SK',
            'journal' => 'Journal of Dhaka National Medical College & Hospital',
            'publication_date' => '2018',
            'volume_issue' => '24(01): 48-51',
            'type' => 'case_report',
            'is_published' => true,
        ]);

        // Create Lifestyle Items - Nutrition
        LifestyleItem::create([
            'category' => 'nutrition',
            'title' => 'Omega-3 Fatty Acids',
            'icon' => 'fas fa-fish',
            'description' => 'Consume fatty fish like salmon, mackerel, and sardines at least twice a week. Omega-3s support brain cell structure and reduce inflammation.',
            'order' => 1,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'nutrition',
            'title' => 'Leafy Greens',
            'icon' => 'fas fa-leaf',
            'description' => 'Include spinach, kale, and other leafy vegetables daily. They\'re rich in vitamins K, folate, and antioxidants that protect brain health.',
            'order' => 2,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'nutrition',
            'title' => 'Berries & Fruits',
            'icon' => 'fas fa-apple-alt',
            'description' => 'Blueberries, strawberries, and other colorful fruits contain flavonoids that may improve memory and cognitive function.',
            'order' => 3,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'nutrition',
            'title' => 'Moderate Caffeine',
            'icon' => 'fas fa-coffee',
            'description' => 'Coffee and tea in moderation can enhance alertness and may have neuroprotective effects. Limit to 2-3 cups daily.',
            'order' => 4,
            'is_active' => true,
        ]);

        // Create Lifestyle Items - Exercise
        LifestyleItem::create([
            'category' => 'exercise',
            'title' => 'Aerobic Exercise',
            'icon' => 'fas fa-running',
            'description' => '30 minutes of moderate aerobic activity 5 times a week improves blood flow to the brain and promotes neuroplasticity.',
            'order' => 1,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'exercise',
            'title' => 'Strength Training',
            'icon' => 'fas fa-dumbbell',
            'description' => 'Include resistance exercises 2-3 times weekly to maintain muscle mass and support neurological health.',
            'order' => 2,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'exercise',
            'title' => 'Yoga & Balance',
            'icon' => 'fas fa-spa',
            'description' => 'Practice yoga or tai chi for balance, coordination, and stress reduction. These activities support the nervous system.',
            'order' => 3,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'exercise',
            'title' => 'Social Activities',
            'icon' => 'fas fa-users',
            'description' => 'Engage in group activities or sports. Social interaction combined with physical activity enhances brain health.',
            'order' => 4,
            'is_active' => true,
        ]);

        // Create Lifestyle Items - Habits
        LifestyleItem::create([
            'category' => 'habits',
            'title' => 'Quality Sleep',
            'icon' => 'fas fa-moon',
            'description' => 'Aim for 7-9 hours of quality sleep nightly. Sleep is essential for memory consolidation and brain detoxification.',
            'points' => [
                'Keep bedroom cool and dark',
                'Maintain consistent sleep times',
                'Avoid screens 1 hour before bed',
                'Limit caffeine after 2 PM'
            ],
            'order' => 1,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'habits',
            'title' => 'Mental Stimulation',
            'icon' => 'fas fa-brain',
            'description' => 'Keep your brain active with puzzles, reading, learning new skills, or playing musical instruments to build cognitive reserve.',
            'points' => [
                'Learn a new language',
                'Practice card or board games',
                'Read diverse genres',
                'Take up a new hobby'
            ],
            'order' => 2,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'habits',
            'title' => 'Hydration',
            'icon' => 'fas fa-tint',
            'description' => 'Drink 8-10 glasses of water daily. Dehydration can affect concentration, memory, and overall brain function.',
            'points' => [
                'Start day with a glass of water',
                'Eat water-rich fruits',
                'Keep a water bottle handy',
                'Limit sugary drinks'
            ],
            'order' => 3,
            'is_active' => true,
        ]);

        LifestyleItem::create([
            'category' => 'habits',
            'title' => 'Avoid Harmful Habits',
            'icon' => 'fas fa-ban',
            'description' => 'Quit smoking and limit alcohol. These substances increase risk of stroke, dementia, and other neurological conditions.',
            'points' => [
                'Seek support to quit smoking',
                'Limit alcohol to 1-2 drinks',
                'Avoid recreational drugs',
                'Manage medications carefully'
            ],
            'order' => 4,
            'is_active' => true,
        ]);

        // Create Sample Articles
        Article::create([
            'title' => 'CT Scan of Brain',
            'slug' => 'ct-scan-of-brain',
            'content' => 'A CT (Computed Tomography) scan of the brain is a medical imaging test that uses X-rays and computer technology to create detailed cross-sectional images of the brain and skull. This non-invasive procedure helps diagnose various neurological conditions.',
            'category' => 'CT Scan, Research',
            'read_time' => 5,
            'is_published' => true,
        ]);

        Article::create([
            'title' => 'EMG (Electromyography)',
            'slug' => 'emg-electromyography',
            'content' => 'An Electromyography (EMG) is a diagnostic test that measures the electrical activity of muscles. This test helps identify muscle and nerve disorders, providing valuable information about muscle function and nerve conduction.',
            'category' => 'EMG, Research',
            'read_time' => 5,
            'is_published' => true,
        ]);

        Article::create([
            'title' => 'Brain Health: Foods That Boost Cognitive Function',
            'slug' => 'brain-health-foods',
            'content' => 'Discover the best foods for optimal brain health and cognitive function. Learn how nutrition impacts your neurological wellness.',
            'category' => 'Healthy Lifestyle',
            'read_time' => 5,
            'is_published' => true,
        ]);

        // Create Settings
        Setting::set('Dr. Mohammad Aftab Muhid is a dedicated and experienced neurologist...', 'about_content');
        Setting::set('site_email', 'info@drMuhid.com');
        Setting::set('site_phone', '10647');
    }
}
