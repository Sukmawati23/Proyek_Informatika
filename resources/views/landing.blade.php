<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi Buku | Satu Buku, Sejuta Manfaat</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #00001a;
            color: #e6f0ff;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Struktur Kristal — Flower of Life Modern */
        .crystal-core {
            position: relative;
            width: 400px;
            height: 400px;
            margin: 0 auto 2.2rem;
        }

        .core-circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border-radius: 50%;
            border: 1px solid rgba(212, 175, 55, 0.15);
            box-shadow: 
                0 0 40px rgba(0, 0, 128, 0.4),
                inset 0 0 20px rgba(212, 175, 55, 0.1);
        }

        /* 6 Lingkaran mengelilingi inti — membentuk Flower of Life */
        .petal {
            position: absolute;
            border-radius: 50%;
            border: 1px solid rgba(100, 150, 255, 0.1);
        }

        /* Inti Kristal — tempat Logo Anda */
        .core {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 20;
        }

        .core::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(circle, 
                rgba(212, 175, 55, 0.4) 0%, 
                rgba(100, 149, 237, 0.2) 50%, 
                transparent 80%);
            filter: blur(10px);
            z-index: -1;
        }

        .core img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 12px;
            box-shadow: 
                0 0 0 2px rgba(255, 255, 255, 0.1),
                0 10px 30px rgba(212, 175, 55, 0.3),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
            filter: drop-shadow(0 5px 15px rgba(0, 0, 128, 0.5));
        }

        /* Partikel buku berputar — seperti elektron */
        .electron {
            position: absolute;
            font-size: 1.2rem;
            color: #D4AF37;
            z-index: 5;
            text-shadow: 0 0 10px rgba(212, 175, 55, 0.7);
        }

        /* Cahaya memancar dari inti */
        .ray {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 2px;
            height: 200px;
            background: linear-gradient(to top, transparent, rgba(212, 175, 55, 0.6), transparent);
            transform-origin: bottom center;
            opacity: 0.6;
            filter: blur(1px);
        }

        h1 {
            font-family: 'Playfair+Display', serif;
            font-weight: 800;
            font-size: 2.9rem;
            text-align: center;
            margin: 1rem 0 0.5rem;
            background: linear-gradient(90deg, #ffffff, #D4AF37, #a0aec0);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: 1.2px;
        }

        .tagline {
            font-family: 'Playfair+Display', serif;
            font-size: 1.55rem;
            color: #D4AF37;
            text-align: center;
            margin-bottom: 2rem;
            font-style: italic;
            position: relative;
        }

        .tagline::before,
        .tagline::after {
            content: "”";
            font-size: 2.1rem;
            color: #D4AF3740;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 1.1rem 3.2rem;
            background: linear-gradient(145deg, #ffffff, #f8fafc);
            color: #000080;
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.45s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            letter-spacing: 1.2px;
            box-shadow: 
                0 10px 30px rgba(0, 0, 128, 0.35),
                0 0 0 2px rgba(212, 175, 55, 0.25);
            position: relative;
            overflow: hidden;
            z-index: 10;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
            transform: translateX(-100%);
            transition: transform 0.9s ease;
        }

        .btn:hover {
            transform: translateY(-6px) scale(1.04);
            box-shadow: 
                0 14px 40px rgba(212, 175, 55, 0.5),
                0 0 0 3px rgba(212, 175, 55, 0.5);
        }

        .btn:hover::before {
            transform: translateX(100%);
        }

        .footer {
            margin-top: 2.2rem;
            font-size: 0.95rem;
            color: #a0aec0;
            text-align: center;
            max-width: 520px;
            line-height: 1.6;
        }

        @media (max-width: 550px) {
            .crystal-core { width: 340px; height: 340px; }
            h1 { font-size: 2.3rem; }
            .tagline { font-size: 1.3rem; }
            .core { width: 150px; height: 150px; }
        }
    </style>
</head>
<body>
    <!-- Struktur Kristal Literasi -->
    <div class="crystal-core" id="crystal">
        <!-- Inti — Logo Anda -->
        <div class="core">
            <img src="{{ asset('LOGO-SDB.png') }}" alt="Logo Donasi Buku"
                onerror="this.style.display='none'; this.parentElement.innerHTML='<div style=\'font-size:4.5rem;color:#D4AF37\'>💎</div>'">
        </div>

        <!-- 6 Lingkaran Flower of Life -->
        <div class="core-circle" style="width:200px;height:200px;"></div>
        <div class="core-circle" style="width:280px;height:280px;"></div>
        <div class="core-circle" style="width:360px;height:360px;"></div>

        <!-- Petal (6 lingkaran offset) -->
        <!-- Akan di-generate via JS untuk presisi -->

        <!-- Sinar memancar -->
        <!-- Akan di-generate via JS -->

        <!-- Partikel buku (elektron) -->
        <!-- Akan di-generate via JS -->
    </div>

    <h1>Donasi Buku</h1>
    <p class="tagline">Satu Buku, Sejuta Manfaat</p>
    <a href="{{ route('login') }}" class="btn">Mulai Donasi</a>
    <p class="footer">
        Seperti kristal yang menyatukan cahaya, setiap donasi Anda menyatukan harapan — menjadi kekuatan yang tak terbendung.
    </p>

    <script>
        const crystal = document.getElementById('crystal');
        const centerX = 200; // half of 400px
        const centerY = 200;

        // Buat 6 lingkaran "petal" Flower of Life
        for (let i = 0; i < 6; i++) {
            const angle = (i / 6) * Math.PI * 2;
            const x = centerX + 100 * Math.cos(angle);
            const y = centerY + 100 * Math.sin(angle);
            
            const petal = document.createElement('div');
            petal.classList.add('petal');
            petal.style.width = '200px';
            petal.style.height = '200px';
            petal.style.left = `${x - 100}px`;
            petal.style.top = `${y - 100}px`;
            crystal.appendChild(petal);
        }

        // Buat 12 sinar memancar
        for (let i = 0; i < 12; i++) {
            const ray = document.createElement('div');
            ray.classList.add('ray');
            const angle = (i / 12) * Math.PI * 2;
            ray.style.transform = `translate(-50%, -50%) rotate(${angle}rad)`;
            ray.style.animation = `pulseRay ${3 + i*0.5}s infinite alternate`;
            crystal.appendChild(ray);
        }

        // Buat partikel buku berputar (elektron)
        const books = ['📚', '📖', '📕', '📘', '📗'];
        for (let i = 0; i < 8; i++) {
            const electron = document.createElement('div');
            electron.classList.add('electron');
            electron.textContent = books[i % books.length];
            
            const radius = 120 + (i % 3) * 40;
            const angle = Math.random() * Math.PI * 2;
            electron.style.left = `${centerX + radius * Math.cos(angle)}px`;
            electron.style.top = `${centerY + radius * Math.sin(angle)}px`;
            
            // Animasi orbit
            electron.style.animation = `orbit${i} ${8 + i*2}s linear infinite`;
            const keyframes = `
                @keyframes orbit${i} {
                    0% { transform: translate(0,0); }
                    100% { transform: translate(${2 * Math.PI * radius}px, 0) rotate(${360}deg); }
                }
            `;
            const style = document.createElement('style');
            style.textContent = keyframes;
            document.head.appendChild(style);
            
            crystal.appendChild(electron);
        }

        // Animasi sinar berdenyut
        const style = document.createElement('style');
        style.textContent = `
            @keyframes pulseRay {
                0% { opacity: 0.2; height: 150px; }
                100% { opacity: 0.8; height: 220px; }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>

