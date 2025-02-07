<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System - Discover Your Next Read</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }

        .btn-hover {
            transition: all 0.3s ease;
        }

        .btn-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}
    </style>
</head>

<body class="bg-gray-50 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-blue-600 transform transition duration-300 ease-in-out hover:scale-105">Edu<span
                    class="text-gray-800">Lib</span></a>
            <div class="flex space-x-4 items-center">
                <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="#about" class="text-gray-700 hover:text-blue-600">About</a>
                <a href="#contact" class="text-gray-700 hover:text-blue-600">Contact</a>

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center text-gray-700 hover:text-blue-600">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center text-gray-700 hover:text-blue-600">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen bg-cover bg-center flex items-center justify-center"
        style="background-image: url('{{ asset('images/shelf-books.jpg') }}');">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 animate-fade-in-up">
                Discover Your Next Read
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 mb-8 animate-fade-in-up delay-100">
                Explore thousands of books from various genres and authors.
            </p>
            <a href="{{ route('book.catalog') }}"
                class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-fade-in-up delay-200">
                Browse Catalog
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12 fade-in">Why Choose Us?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="text-center fade-in ">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Wide Selection</h3>
                    <p class="text-gray-600">Access a vast collection of books from various genres and authors.</p>
                </div>
                <!-- Feature 2 -->
                <div class="text-center fade-in">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Community Driven</h3>
                    <p class="text-gray-600">Join a community of book lovers and share your reading experiences.</p>
                </div>
                <!-- Feature 3 -->
                <div class="text-center fade-in">
                    <div class="text-4xl text-blue-600 mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">24/7 Access</h3>
                    <p class="text-gray-600">Enjoy unlimited access to our library anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-gray-100 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <!-- Gambar Library -->
                <div class="fade-in">
                    <img src="{{ asset('images/library-about.png') }}" alt="Library"
                        class="rounded-lg shadow-lg w-full h-auto transform transition duration-300 ease-in-out hover:scale-105">
                </div>
                <!-- Teks About Us -->
                <div class="fade-in">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
                    <p class="text-gray-600 mb-4">
                        Welcome to <span class="font-semibold text-blue-600">EduLib</span>, your gateway to a world of
                        knowledge and imagination. We are a community-driven library dedicated to providing access to a
                        wide range of books for all readers.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Our mission is to promote literacy, foster a love for reading, and create a welcoming space for
                        book enthusiasts of all ages. Whether you're looking for the latest bestsellers, classic
                        literature, or academic resources, we've got you covered.
                    </p>
                    <p class="text-gray-600 mb-4">
                        Join us in our journey to make reading accessible and enjoyable for everyone. Explore our
                        collection, attend our events, and become part of our vibrant community.
                    </p>
                    <a href="#contact"
                        class="btn-hover bg-blue-600 text-white px-6 py-2 rounded-full font-semibold inline-block">Get
                        in Touch</a>
                </div>
            </div>
        </div>
    </section>

    <!--  Books Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12 fade-in">New Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($newBooks as $book)
                <div class="bg-white rounded-lg shadow-lg p-10 backdrop-blur-md hover:shadow-xl transition duration-300">
                    <a href="{{ route('book.show', ['id' => $book->id]) }}" class="book-cover">
                        <img class="w-full h-auto aspect-[2/3] object-cover rounded-lg transform transition duration-300 ease-in-out hover:scale-105" 
                             src="{{ $book->cover_image ? Storage::url($book->cover_image) : asset('images/default-cover.jpg') }}" 
                             alt="{{ $book->title }}">
                    </a>
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-slate-700 mb-2 line-clamp-2">{{ $book->title }}</h2>
                        <h5 class="text-md text-slate-700 mb-2 line-clamp-3">Author By {{ $book->author }}</h5>
                        <p class="text-sm text-gray-700 mb-2 line-clamp-3">{{ $book->description }}</p>

                        <div class="flex items-center justify-center mb-4">
                            <a href="{{ route('book.show', ['id' => $book->id]) }}"
                               class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-blue-700 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 animate-fade-in-up delay-200">
                                More
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    

    <!-- Contact Section -->
    <section id="contact" class="bg-white py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12 fade-in">Contact Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Form Kontak -->
                <div class="bg-gray-100 p-8 rounded-lg shadow-lg fade-in h-full">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Your Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter your email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Enter your message"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-blue-500" required></textarea>
                        </div>
                        <div>
                            <button type="submit"
                                class="btn-hover bg-blue-600 text-white px-6 py-3 rounded-full font-semibold w-full">Send
                                Message</button>
                        </div>
                    </form>
                </div>
                <!-- Informasi Kontak -->
                <div class="bg-gray-100 p-8 rounded-lg shadow-lg fade-in h-full">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
                    <p class="text-gray-600 mb-4">
                        Have questions or feedback? We'd love to hear from you! Reach out to us using the form or the
                        contact details below.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="text-blue-600 mr-6">
                                <i class="fas fa-map-marker-alt text-2xl"></i>
                            </div>
                            <p class="text-gray-600">123 Library Street, Malang, POS code 12345</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-blue-600 mr-4">
                                <i class="fas fa-phone-alt text-2xl"></i>
                            </div>
                            <p class="text-gray-600">+62 23-456-7890</p>
                        </div>
                        <div class="flex items-center">
                            <div class="text-blue-600 mr-4">
                                <i class="fas fa-envelope text-2xl"></i>
                            </div>
                            <p class="text-gray-600">info@edulib.com</p>
                        </div>
                    </div>
                    <div class="mt-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Follow Us</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="text-blue-600 hover:text-blue-700">
                                <i class="fab fa-facebook text-2xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-700">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-700">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <a href="#" class="text-blue-600 hover:text-blue-700">
                                <i class="fab fa-linkedin text-2xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; 2025 EduLib. All rights reserved.</p>
            <div class="mt-4">
                <a href="#" class="text-gray-400 hover:text-white mx-2">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-white mx-2">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, {
                threshold: 0.5
            });

            fadeElements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>

</html>
