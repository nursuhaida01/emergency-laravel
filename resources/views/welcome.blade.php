<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> มูลนิธิแม่กอเหนียวยะลา</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            /* Custom Tailwind CSS */
            body {
                font-family: 'Figtree', sans-serif;
            }
            .background {
                position: absolute;
                left: 0;
                top: 0;
                max-width: 50%;
                height: 100%;
                z-index: -1;
            }
            .header-nav a, .header-nav button {
                padding: 0.75rem 1.5rem;
                margin: 0 0.5rem;
                transition: color 0.3s ease, background-color 0.3s ease;
                border-radius: 0.375rem;
                border: 1px solid transparent;
                background-color: white;
                color: black;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .header-nav a:hover, .header-nav button:hover {
                color: #FF2D20;
                background-color: #f1f5f9;
            }
            .header-nav a:focus-visible, .header-nav button:focus-visible {
                outline: 2px solid #FF2D20;
                outline-offset: 2px;
            }
            .content {
                background-color: white;
                padding: 2rem;
                border-radius: 0.375rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 2rem;
            }
            .content h1 {
                font-size: 1.5rem;
                margin-bottom: 1rem;
                color: #FF2D20;
            }
            .content p {
                margin-bottom: 0.75rem;
            }
            .content .details {
                margin-top: 1.5rem;
                background-color: #f9fafb;
                padding: 1rem;
                border-radius: 0.375rem;
            }
            .content .details h2 {
                font-size: 1.25rem;
                margin-bottom: 0.5rem;
            }
            .login-button {
                display: flex;
                justify-content: center;
                margin-top: 2rem;
            }
            .login-button button {
                padding: 0.75rem 2rem;
                background-color: #FF2D20;
                color: white;
                border: none;
                border-radius: 0.375rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
            .login-button button:hover {
                background-color: #e0241c;
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">
            <img id="background" class="background" src="https://laravel.com/assets/img/welcome/background.svg" />
            <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <nav class="header-nav -mx-3 flex flex-1 justify-end">
                        <a href="{{ url('/dashboard') }}" class="text-black dark:text-white">
                            ยินดีต้อนรับเข้าสู่ระบบ
                        </a>
                    </nav>
                </header>
                

                <div class="content">
                    <h1>มูลนิธิแม่กอเหนียวยะลา</h1>
                    <p>สถานที่เกิดเหตุ: ถนนสาย 408</p>
                    <p>วันที่: 15 สิงหาคม 2024</p>
                    <p>เวลา: 14:30 น.</p>
                    <p>ประเภทอุบัติเหตุ: รถยนต์ชนกับรถจักรยานยนต์</p>

                    <div class="details">
                        <h2>รายละเอียดเพิ่มเติม:</h2>
                        <p>มีผู้บาดเจ็บ 2 รายและผู้เสียชีวิต 1 ราย สภาพการจราจรติดขัดเนื่องจากเกิดเหตุที่ทางแยกสำคัญ เจ้าหน้าที่ได้เข้าช่วยเหลือและนำตัวผู้บาดเจ็บส่งโรงพยาบาลที่ใกล้ที่สุดทันที</p>
                    </div>

                 
                </div>
            </div>
        </div>
    </body>
</html>
