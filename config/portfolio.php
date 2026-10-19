<?php

/*
|--------------------------------------------------------------------------
| Portfolio Content
|--------------------------------------------------------------------------
|
| All website content lives in this single file. Update the copy, links,
| skills, projects, experience and services here — no Blade templates
| need to be touched.
|
*/

return [

    'logo' => 'KIMLAY.',

    'role' => 'Full-Stack Developer & Creative Problem Solver',

    'tagline' => 'I build modern, responsive, and high-performance web applications that combine clean design with powerful technology.',

    'availability' => 'Available for freelance projects',

    'meta_title' => 'Kimlay — Full-Stack Developer in Phnom Penh',
    'meta_description' => 'Kimlay is a full-stack developer based in Phnom Penh, Cambodia, specializing in Laravel, React, Node.js and modern web applications. Contact: +855 14 549 059 or Chhunkimlay248@email.co',
    'canonical_url' => 'https://kimlay.dev',
    'og_type' => 'website',
    'og_image' => 'images/hero-avatar.svg',
    'twitter_handle' => '@kimlay',
    'organization_name' => 'Kimlay',
    'organization_email' => 'Chhunkimlay248@email.co',
    'organization_phone' => '+855 14 549 059',
    'organization_address' => 'Phnom Penh, Cambodia',
    'geo_latitude' => '11.5564',
    'geo_longitude' => '104.9282',
    'timezone' => 'Asia/Phnom_Penh',
    'language' => 'en',

    'nav' => [
        ['label' => 'Home', 'href' => '#home'],
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Skills', 'href' => '#skills'],
        ['label' => 'Projects', 'href' => '#projects'],
        ['label' => 'Experience', 'href' => '#experience'],
        ['label' => 'Services', 'href' => '#services'],
        ['label' => 'Contact', 'href' => '#contact'],
    ],

    'hero' => [
        'greeting' => "Hello, I'm",
        'name' => 'Kimlay',
        'image' => 'images/hero-avatar.svg',
        'chips' => ['HTML', 'CSS', 'JavaScript', 'Laravel', 'React', 'Node.js'],
    ],

    'about' => [
        'tag' => 'About Me',
        'heading' => 'A little about me',
        'image' => 'images/about-portrait.svg',
        'badge_value' => '3+',
        'badge_label' => 'Years of Experience',
        'paragraphs' => [
            "I'm a passionate developer who enjoys transforming ideas into functional digital experiences. I focus on building clean, maintainable applications while continuously learning new technologies.",
            'My journey began with curiosity about how the web works — it quickly grew into a craft. Today I build complete web products, from pixel-perfect interfaces to secure backend systems and databases.',
            "When I'm not coding, I'm exploring new tools, building side projects, and sharpening my design eye.",
        ],
        'stats' => [
            ['value' => 3, 'suffix' => '+', 'label' => 'Years Experience'],
            ['value' => 20, 'suffix' => '+', 'label' => 'Projects'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Technologies'],
            ['value' => 100, 'suffix' => '%', 'label' => 'Passion'],
        ],
    ],

    'skills' => [
        [
            'category' => 'Frontend',
            'icon' => 'layout',
            'blurb' => 'Responsive, accessible interfaces.',
            'items' => [
                ['name' => 'HTML', 'abbr' => 'HT', 'level' => 95, 'color' => '#e34f26'],
                ['name' => 'CSS', 'abbr' => 'CS', 'level' => 92, 'color' => '#2965f1'],
                ['name' => 'JavaScript', 'abbr' => 'JS', 'level' => 90, 'color' => '#f7df1e'],
                ['name' => 'React', 'abbr' => 'RE', 'level' => 30, 'color' => '#61dafb'],
                ['name' => 'Tailwind CSS', 'abbr' => 'TW', 'level' => 40, 'color' => '#38bdf8'],
            ],
        ],
        [
            'category' => 'Backend',
            'icon' => 'server',
            'blurb' => 'APIs, auth & application logic.',
            'items' => [
                ['name' => 'Node.js', 'abbr' => 'ND', 'level' => 50, 'color' => '#3c873a'],
                ['name' => 'Express.js', 'abbr' => 'EX', 'level' => 60, 'color' => '#9ca3af'],
                ['name' => 'Laravel', 'abbr' => 'LA', 'level' => 70, 'color' => '#ff2d20'],
                ['name' => 'REST API', 'abbr' => 'API', 'level' => 60, 'color' => '#34d399'],
            ],
        ],

        [
            'category' => 'Database',
            'icon' => 'database',
            'blurb' => 'Modeling & fast queries.',
            'items' => [
                ['name' => 'MySQL', 'abbr' => 'MY', 'level' => 85, 'color' => '#4479a1'],
                ['name' => 'MongoDB', 'abbr' => 'MO', 'level' => 78, 'color' => '#47a248'],
                ['name' => 'Redis', 'abbr' => 'RD', 'level' => 72, 'color' => '#dc382d'],
            ],
        ],
        [
            'category' => 'Tools',
            'icon' => 'tool',
            'blurb' => 'Shipping & collaborating daily.',
            'items' => [
                ['name' => 'Git', 'abbr' => 'GT', 'level' => 90, 'color' => '#f05033'],
                ['name' => 'GitHub', 'abbr' => 'GH', 'level' => 90, 'color' => '#e6edf3'],
                ['name' => 'Docker', 'abbr' => 'DK', 'level' => 75, 'color' => '#2496ed'],
                ['name' => 'VS Code', 'abbr' => 'VS', 'level' => 95, 'color' => '#3da7f5'],
                ['name' => 'Postman', 'abbr' => 'PM', 'level' => 85, 'color' => '#ff6c37'],
            ],
        ],
    ],

    'projects' => [
        [
            'name' => 'ShopLayo',
            'description' => 'An online shopping platform with product management, authentication, shopping cart functionality, and secure backend APIs.',
            'image' => 'images/project-shoplayo.svg',
            'technologies' => ['React', 'Node.js', 'Express', 'MySQL'],
            'github' => 'https://github.com/kimlay/shoplayo',
            'demo' => 'https://shoplayo.kimlay.dev',
        ],
        [
            'name' => 'Creative Gallery',
            'description' => 'A photography portfolio platform designed to showcase visual work through an immersive gallery experience.',
            'image' => 'images/project-gallery.svg',
            'technologies' => ['HTML', 'CSS', 'JavaScript'],
            'github' => 'https://github.com/kimlay/creative-gallery',
            'demo' => 'https://gallery.kimlay.dev',
        ],
        [
            'name' => 'TaskFlow',
            'description' => 'A collaborative task management platform with authentication, role-based permissions, and real-time project tracking.',
            'image' => 'images/project-taskflow.svg',
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github' => 'https://github.com/kimlay/taskflow',
            'demo' => 'https://taskflow.kimlay.dev',
        ],
    ],

    'experience' => [
        [
            'period' => '2026 — Present',
            'title' => 'Full-Stack Developer',
            'description' => 'Building modern web applications and backend systems.',
            'current' => true,
        ],
        [
            'period' => '2025 — 2026',
            'title' => 'Web Development',
            'description' => 'Focused on JavaScript, Node.js, Laravel, databases, and API development.',
            'current' => false,
        ],
        [
            'period' => '2024 — 2025',
            'title' => 'Started Programming',
            'description' => 'Learned HTML, CSS, JavaScript, databases, and software development fundamentals.',
            'current' => false,
        ],
    ],

    'services' => [
        [
            'icon' => 'code',
            'title' => 'Web Development',
            'description' => 'Build responsive and modern websites that look great on every device and load fast.',
        ],
        [
            'icon' => 'server',
            'title' => 'Backend Development',
            'description' => 'Create APIs, authentication systems, and database-driven applications with Laravel and Node.js.',
        ],
        [
            'icon' => 'layout',
            'title' => 'UI Development',
            'description' => 'Transform designs into responsive, interactive interfaces with clean, reusable code.',
        ],
        [
            'icon' => 'zap',
            'title' => 'Website Optimization',
            'description' => 'Improve performance, responsiveness, accessibility, and overall user experience.',
        ],
    ],

    'contact' => [
        'heading' => "Let's build something great together.",
        'description' => "Have an idea, project, or opportunity? Send me a message and let's talk.",
        'email' => 'Chhunkimlay248@email.co',
        'phone' => '+855 14 549 059',
        'phone_href' => '+85514549059',
        'location' => 'Phnom Penh, Cambodia',
        'github' => ['label' => 'GitHub', 'handle' => 'github.com/kimlay', 'href' => 'https://github.com/kimlay'],
        'linkedin' => ['label' => 'LinkedIn', 'handle' => 'linkedin.com/in/kimlay', 'href' => 'https://www.linkedin.com/in/kimlay'],
    ],

    'socials' => [
        ['label' => 'GitHub', 'icon' => 'github', 'href' => 'https://github.com/kimlay'],
        ['label' => 'LinkedIn', 'icon' => 'linkedin', 'href' => 'https://www.linkedin.com/in/kimlay'],
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => 'https://www.instagram.com/kimlay'],
        ['label' => 'Facebook', 'icon' => 'facebook', 'href' => 'https://www.facebook.com/kimlay'],
    ],

    'footer' => [
        'tagline' => 'Building digital experiences with code and creativity.',
        'copyright' => '© 2026 Kimlay. All rights reserved.',
    ],
];
