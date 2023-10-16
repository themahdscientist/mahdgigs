<section class="align-center relative mb-4 flex h-72 flex-col justify-center space-y-4 bg-green-500 text-center">
    <div class="bg-image-laravel-logo absolute left-0 top-0 h-full w-full bg-center bg-no-repeat opacity-10"></div>
    <div class="z-10">
        <h1 class="text-6xl font-bold uppercase text-purple-800">MahdGigs</h1>
        <p class="my-4 text-2xl font-bold text-gray-200">
            Find or post Laravel jobs & projects
        </p>
        @guest
            <div>
                <a href="{{ route('users.create') }}"
                    class="mt-2 inline-block rounded-xl border-2 border-white px-4 py-2 uppercase text-white hover:border-laravel hover:text-laravel">Sign
                    Up to List a Gig</a>
            </div>
        @endguest
    </div>
</section>
