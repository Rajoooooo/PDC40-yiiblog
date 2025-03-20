<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-gray-300">

    <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-3xl mx-auto">

        <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Contact Us</h1>

        <p class="text-sm text-gray-600 text-center mb-8">
            We'd love to hear from you. Fill out the form below and we'll get back to you shortly.
        </p>

        <form action="#" method="POST" class="space-y-6">

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">Your Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" required placeholder="Enter your name"
                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">Your Email <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" required placeholder="Enter your email"
                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition" />
            </div>

            <!-- Subject -->
            <div>
                <label for="subject" class="block text-gray-700 font-medium mb-2">Subject <span class="text-red-500">*</span></label>
                <input type="text" id="subject" name="subject" required placeholder="Enter the subject"
                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition" />
            </div>

            <!-- Message -->
            <div>
                <label for="message" class="block text-gray-700 font-medium mb-2">Your Message <span class="text-red-500">*</span></label>
                <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."
                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-500 transition"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                    class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-xl shadow-lg hover:from-indigo-700 hover:to-blue-600 transition-transform transform hover:scale-105 duration-300">
                    Send Message
                </button>
            </div>

        </form>

    </div>

</body>

</html>
