<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You Found Me!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes glow {
            0%, 100% { text-shadow: 0 0 10px #fff; }
            50% { text-shadow: 0 0 20px #fff, 0 0 30px #3b82f6; }
        }
        
        @keyframes sparkle {
            0% { opacity: 0; transform: scale(0); }
            50% { opacity: 1; }
            100% { opacity: 0; transform: scale(1); }
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .glow-animation {
            animation: glow 2s ease-in-out infinite;
        }
        
        .sparkle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
            animation: sparkle 1.5s infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-900 to-black min-h-screen overflow-hidden font-['Poppins']">
    
    <!-- Sparkle Effects -->
    <div id="sparkles"></div>
    
    <div class="container mx-auto px-4 min-h-screen flex flex-col items-center justify-center relative">
        
        <!-- Main Text -->
        <div class="text-center relative z-10">
            <h1 class="text-8xl md:text-9xl font-bold mb-6 float-animation">
                <span class="bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 bg-clip-text text-transparent glow-animation">
                    You Found Me!
                </span>
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto">
                Congratulations explorer! You've discovered something special. 
                <span class="text-blue-300 font-semibold">Now what will you do next?</span>
            </p>
            
            <!-- Decorative Elements -->
            <div class="flex justify-center space-x-4 mb-12">
                <div class="w-4 h-4 rounded-full bg-blue-500 animate-pulse"></div>
                <div class="w-4 h-4 rounded-full bg-purple-500 animate-pulse" style="animation-delay: 0.3s"></div>
                <div class="w-4 h-4 rounded-full bg-pink-500 animate-pulse" style="animation-delay: 0.6s"></div>
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="celebrate()" class="px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-full hover:scale-105 transform transition duration-300 hover:shadow-lg hover:shadow-blue-500/50">
                    🎉 Celebrate!
                </button>
                <button onclick="showSurprise()" class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-semibold rounded-full hover:scale-105 transform transition duration-300 hover:shadow-lg hover:shadow-pink-500/50">
                    ✨ Show Surprise
                </button>
                <a href="/" class="px-8 py-3 bg-gray-800 text-white font-semibold rounded-full hover:scale-105 transform transition duration-300 hover:bg-gray-700 text-center">
                    ← Go Back
                </a>
            </div>
        </div>
        
        <!-- Background Elements -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>
        
        <!-- Corner Decorations -->
        <div class="absolute top-8 left-8 text-blue-400 text-lg">✦</div>
        <div class="absolute top-8 right-8 text-purple-400 text-lg">✦</div>
        <div class="absolute bottom-8 left-8 text-pink-400 text-lg">✦</div>
        <div class="absolute bottom-8 right-8 text-blue-400 text-lg">✦</div>
        
    </div>
    
    <!-- Footer -->
    <div class="absolute bottom-4 w-full text-center text-gray-500 text-sm">
        <p>Made with ❤️ using Laravel & Tailwind CSS</p>
    </div>

    <script>
        // Create sparkles
        function createSparkles() {
            const container = document.getElementById('sparkles');
            for(let i = 0; i < 20; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'sparkle';
                sparkle.style.left = Math.random() * 100 + 'vw';
                sparkle.style.top = Math.random() * 100 + 'vh';
                sparkle.style.animationDelay = Math.random() * 2 + 's';
                container.appendChild(sparkle);
            }
        }
        
        // Celebration effect
        function celebrate() {
            const text = document.querySelector('h1');
            text.classList.add('scale-125');
            setTimeout(() => text.classList.remove('scale-125'), 300);
            
            // Create confetti effect
            for(let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'absolute w-3 h-3 rounded-full';
                confetti.style.backgroundColor = ['#3b82f6', '#8b5cf6', '#ec4899'][Math.floor(Math.random() * 3)];
                confetti.style.left = '50%';
                confetti.style.top = '50%';
                confetti.style.transform = `translate(${Math.random() * 200 - 100}px, ${Math.random() * 200 - 100}px)`;
                document.body.appendChild(confetti);
                
                setTimeout(() => confetti.remove(), 1000);
            }
        }
        
        // Show surprise message
        function showSurprise() {
            alert("🎁 Surprise! You're amazing!\n\nKeep exploring and discovering new things!");
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', createSparkles);
    </script>
</body>
</html>