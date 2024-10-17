<!doctype html>
<html lang="en">

<head>
    <title>Projet Php</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <header>
        <nav class="bg-gray-100">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <a class="text-lg font-bold" href="#">Projet php</a>
                <button class="text-gray-500 block lg:hidden" id="navbar-toggler">
                    <!-- Hamburger icon -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <div class="hidden lg:flex" id="navbar-menu">
                    <ul class="flex space-x-6">
                        <li>
                            <a class="text-blue-500 hover:text-blue-700 font-semibold" href="<?= WEBROOT?>/controller=article&?action=liste-article">Article</a>
                        </li>
                        <li>
                            <a class="text-gray-700 hover:text-blue-500" href="<?= WEBROOT?>/controller=approvisionnement&?action=liste-approvisionnement">Approvisionnement</a>
                        </li>
                        <li class="relative">
                            <button class="text-gray-700 hover:text-blue-500 flex items-center" id="dropdown-button">
                                T/C
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute hidden bg-white shadow-lg rounded-lg mt-2 w-48" id="dropdown-menu">
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= WEBROOT?>/?controller=type&action=liste-type">Types</a>
                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="<?= WEBROOT?>/?controller=categorie&action=liste-categorie">Catégories</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container mx-auto my-10">
        <?php
            echo $contentView;
        ?>
    </main>

    <!-- Optional JavaScript for dropdown -->
    <script>
        document.getElementById('dropdown-button').addEventListener('click', function () {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });
        document.getElementById('navbar-toggler').addEventListener('click', function () {
            document.getElementById('navbar-menu').classList.toggle('hidden');
        });
    </script>
</body>

</html>
