<?php

/*
|--------------------------------------------------------------------------
| Portfolio Content
|--------------------------------------------------------------------------
|
| All default website content lives in this single file. Update copy, links,
| skills, projects, experience and services here — used by PortfolioSeeder
| as the default data source.
|
*/

return [

    'logo' => 'KIMLAY.',

    'role' => 'Web Developer & Creative Problem Solver',

    'tagline' => 'I build modern, responsive, and high-performance web applications that combine clean design with powerful technology.',

    'availability' => 'Available for freelance projects',

    'meta_title' => 'Kimlay — Full-Stack Developer in Phnom Penh',
    'meta_description' => 'Kimlay is a full-stack developer based in Phnom Penh, Cambodia, specializing in Laravel, React, Node.js and modern web applications.',
    'canonical_url' => 'https://kimlay.dev',
    'og_type' => 'website',
    'og_image' => 'uploads/hero/1qPdVsJNV5LMjyBfWlcMJZ7bzgkYsn7QlySXLMCr.jpg',
    'twitter_handle' => '@kimlay',
    'organization_name' => 'Chhun Kimlay',
    'organization_email' => 'chhunkimlay248@gmail.com',
    'organization_phone' => '+85514549059',
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
        'image' => 'uploads/hero/1qPdVsJNV5LMjyBfWlcMJZ7bzgkYsn7QlySXLMCr.jpg',
        'chips' => ['HTML', 'CSS', 'JavaScript', 'Laravel', 'Express', 'Node.js'],
    ],

    'about' => [
        'tag' => 'About Me',
        'heading' => 'A little about me',
        'image' => 'images/about-portrait.svg',
        'badge_value' => '1',
        'badge_label' => 'Years of Experience',
        'paragraphs' => [
            "I'm a passionate developer who enjoys transforming ideas into functional digital experiences. I focus on building clean, maintainable applications while continuously learning new technologies.",
            "My journey began with curiosity about how the web works — it quickly grew into a craft. Today I build complete web products, from pixel-perfect interfaces to secure backend systems and databases.",
            "When I'm not coding, I'm exploring new tools, building side projects, and sharpening my design eye.",
        ],
        'stats' => [
            ['value' => 1, 'suffix' => '+', 'label' => 'Years Experience'],
            ['value' => 5, 'suffix' => '+', 'label' => 'Projects'],
            ['value' => 10, 'suffix' => '+', 'label' => 'Technologies'],
            ['value' => 100, 'suffix' => '%', 'label' => 'Passion'],
        ],
    ],

    'socials' => [
        ['label' => 'GitHub', 'icon' => 'github', 'href' => 'https://github.com/Usernamehelloword'],
        ['label' => 'LinkedIn', 'icon' => 'linkedin', 'href' => 'https://www.linkedin.com/in/kimlay'],
        ['label' => 'Instagram', 'icon' => 'instagram', 'href' => 'https://www.instagram.com/kimlay'],
        ['label' => 'Facebook', 'icon' => 'facebook', 'href' => 'https://www.facebook.com/kimlay'],
    ],

    'skills' => [
        [
            'category' => 'Frontend',
            'icon' => 'layout',
            'blurb' => 'Responsive, accessible interfaces.',
            'items' => [
                ['name' => 'HTML', 'abbr' => 'HT', 'level' => 95, 'color' => '#e34f26'],
                ['name' => 'CSS', 'abbr' => 'CS', 'level' => 92, 'color' => '#2965f1'],
                ['name' => 'JavaScript', 'abbr' => 'JS', 'level' => 50, 'color' => '#f7df1e'],
                ['name' => 'Flutter', 'abbr' => 'RE', 'level' => 30, 'color' => '#61dafb'],
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
                ['name' => 'MySQL', 'abbr' => 'MY', 'level' => 50, 'color' => '#4479a1'],
                ['name' => 'MongoDB', 'abbr' => 'MO', 'level' => 50, 'color' => '#47a248'],
                ['name' => 'Redis', 'abbr' => 'RD', 'level' => 20, 'color' => '#dc382d'],
            ],
        ],
        [
            'category' => 'Tools',
            'icon' => 'tool',
            'blurb' => 'Shipping & collaborating daily.',
            'items' => [
                ['name' => 'Git', 'abbr' => 'GT', 'level' => 50, 'color' => '#f05033'],
                ['name' => 'GitHub', 'abbr' => 'GH', 'level' => 50, 'color' => '#e6edf3'],
                ['name' => 'VS Code', 'abbr' => 'VS', 'level' => 60, 'color' => '#3da7f5'],
                ['name' => 'Postman', 'abbr' => 'PM', 'level' => 40, 'color' => '#ff6c37'],
            ],
        ],
    ],

    'projects' => [
        [
            'name' => 'View Picture',
            'description' => 'An online picture Landing page. (Netlify)',
            'image' => 'uploads/projects/LPRPhXEYa8WS4dYRqekR8fjWfLbJzKuATP1dTNEc.png',
            'technologies' => ['Html', 'Css', 'Javascript'],
            'github' => 'https://github.com/Usernamehelloword/testing2',
            'demo' => 'https://gorgeous-cactus-72937a.netlify.app/',
        ],
        [
            'name' => 'Simple_Game_Chess',
            'description' => 'A photography portfolio platform designed to showcase visual work through an immersive gallery experience.',
            'image' => 'uploads/projects/7KrZrsDZ5sPEera87sxl2kyk8ZnC4Fm1TR2YAqIA.png',
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github' => 'https://github.com/Usernamehelloword',
            'demo' => 'https://chess-game-2026.onrender.com',
        ],
        [
            'name' => 'Simple_Chat',
            'description' => 'Build a real-time chat application using WebSockets for instant messaging, secure authentication, private and group chats, online status, message history, typing indicators, notifications, and encrypted communication with scalable backend infrastructure.  ( Render)',
            'image' => 'uploads/projects/7wwhn1EPTAyUvQ5mdrSw6pwp5og4jcoEUOGPwsjc.png',
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github' => 'https://github.com/Usernamehelloword',
            'demo' => 'https://chat-project-373j.onrender.com',
        ],
        [
            'name' => 'Ephac',
            'description' => 'EPHAC is a Cambodian pharmaceutical manufacturer established in 2003. Its manufacturing site is located in Kampong Tralach District, Kampong Chhnang Province.(Hostringer)',
            'image' => 'uploads/projects/FAslMYLA8xP6rWXhNvVCyZ516dg1sNEeiW6HeF9C.png',
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github' => 'none',
            'demo' => 'https://ephac.com/',
        ],
        [
            'name' => 'Seed media',
            'description' => 'A collaborative task management platform with authentication, role-based permissions, and real-time project tracking. (hostringer)',
            'image' => 'uploads/projects/EOVgmkufeF33TqWlbXHqHQchl4E5p2cFzlTdwgx3.png',
            'technologies' => ['Laravel', 'MySQL', 'Tailwind CSS'],
            'github' => 'https://github.com/Usernamehelloword',
            'demo' => 'https://seedmedia.biz/',
        ],
    ],

    'experience' => [
        [
            'period' => '2026 — Present',
            'title' => 'Full-Stack Developer',
            'description' => 'Building modern web applications and backend systems.',
            'is_current' => true,
            'current' => true,
        ],
        [
            'period' => '2025 — 2026',
            'title' => 'Web Development',
            'description' => 'Focused on JavaScript, Node.js, Laravel, databases, and API development.',
            'is_current' => false,
            'current' => false,
        ],
        [
            'period' => '2024 — 2025',
            'title' => 'Started Programming',
            'description' => 'Learned HTML, CSS, JavaScript, databases, and software development fundamentals.',
            'is_current' => false,
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
        'email' => 'chhunkimlay6899@gmail.com',
        'phone' => '+855 14549059',
        'phone_href' => '+85514549059',
        'location' => 'Phnom Penh, Cambodia',
        'github' => [
            'label' => 'GitHub',
            'handle' => 'https://github.com/Usernamehelloword',
            'href' => 'https://github.com/Usernamehelloword',
        ],
        'linkedin' => [
            'label' => 'LinkedIn',
            'handle' => 'linkedin.com/in/kimlay1',
            'href' => 'https://www.linkedin.com/in/kimlay1',
        ],
    ],

    'footer' => [
        'tagline' => 'Building digital experiences with code and creativity.',
        'copyright' => '© 2026 Kimlay. All rights reserved.',
    ],

];
