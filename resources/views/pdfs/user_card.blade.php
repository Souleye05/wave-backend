<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Utilisateur</title>
    <style>
        @page {
            margin: 0;
            size: 85.6mm 53.98mm; /* Taille standard d'une carte bancaire */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .card-container {
            position: relative;
            width: 100%;
            height: 100%;
            perspective: 1000px;
        }

        .card-back {
            position: relative;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #1a237e, #0d47a1, #0277bd);
            background-size: 200% 200%;
            animation: gradientBG 15s ease infinite;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        /* Effet holographique */
        .card-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(125deg, 
                rgba(255,255,255,0) 0%,
                rgba(255,255,255,0.1) 10%,
                rgba(255,255,255,0.2) 20%,
                rgba(255,255,255,0.1) 30%,
                rgba(255,255,255,0) 40%
            );
            background-size: 200% 200%;
            animation: shimmer 5s infinite;
            pointer-events: none;
        }

        .company-logo {
            position: absolute;
            bottom: 15px;
            right: 20px;
            width: 48px;
            height: 48px;
            filter: brightness(0) invert(1);
            opacity: 0.9;
        }

        .qr-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .qr-box {
            background: rgba(255, 255, 255, 0.95);
            width: 45%;
            height: 75%;
            border-radius: 12px;
            padding: 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }

        .qr-code {
            width: 90%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .scan-text {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #1a237e;
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 4px;
        }

        .user-info {
            position: absolute;
            top: 20px;
            left: 20px;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .user-info h2 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .user-info p {
            margin: 5px 0;
            font-size: 12px;
            opacity: 0.9;
            letter-spacing: 0.3px;
        }

        .profile-image {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.8);
            object-fit: cover;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card-back">
            <img src="{{ public_path('images/design.png') }}" alt="Logo" class="company-logo">
            
            <div class="user-info">
                <h2>{{ $data['user']->name }}</h2>
                <p>ID: {{ $data['user']->id }}</p>
                <p>{{ $data['user']->email }}</p>
            </div>

            @if($data['profile_image'])
                <img src="{{ public_path($data['profile_image']) }}" alt="Profile" class="profile-image">
            @endif

            <div class="qr-container">
                <div class="qr-box">
                    <img src="{{ $qrCodePath }}" alt="QR Code" class="qr-code">
                    <div class="scan-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                        <span>Scanner</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>