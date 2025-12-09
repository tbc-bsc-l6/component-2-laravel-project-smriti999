@extends('layouts.app')

@section('content')
<div class="container mx-auto py-12">
    <h1 class="text-4xl font-bold mb-6">Contact Us</h1>
    <p class="text-lg text-gray-700 mb-6">
        Have questions or feedback? We'd love to hear from you. Fill out the form below, and we'll get back to you as soon as possible.
    </p>

    <form action="{{ route('contact') }}" method="POST" class="max-w-lg bg-white p-6 rounded shadow-md">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required>
        </div>

        <div class="mb-4">
            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
            <textarea name="message" id="message" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300" required></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Send Message</button>
    </form>
</div>
@endsection
