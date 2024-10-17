<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Medecin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <nav class="bg-green-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Nom du projet -->
            <div class="text-white text-xl font-bold">
                Clinique 221
            </div>
            <!-- Menu -->
            <div>
                <ul class="flex space-x-6 text-white text-lg">
                    <li>
                        <a href="<?= WEBROOT ?>/?controller=medecin&action=liste-medecin" class="hover:text-gray-300">Medecin</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT ?>/?controller=patient&action=list-patient" class="hover:text-gray-300">Patient</a>
                    </li>
                    <li>
                        <a href="<?= WEBROOT ?>/?controller=rendezvous&action=form-rendezvous" class="hover:text-gray-300">Rendezvous</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto my-10 max-w-lg p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-center text-2xl font-bold text-green-500 mb-6">Nouveau Medecin</h2>
        <form action="index.php?action=add-medecin" method="post">
            <div class="mb-4">
                <label for="nom" class="block text-gray-700 font-semibold mb-2">Nom</label>
                <input type="text" name="nom" id="nom" placeholder="Entrez le nom du Medecin" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label for="prenom" class="block text-gray-700 font-semibold mb-2">Prenom</label>
                <input type="text" name="prenom" id="prenom" placeholder="Entrez la prenom" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div class="mb-4">
                <label for="specialite" class="block text-gray-700 font-semibold mb-2">Specialite</label>
                <input type="text" name="specialite" id="specialite" placeholder="Entrez la specialite" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <input type="hidden" name="controller" value="medecin">
            <input type="hidden" name="action" value="add-medecin">
            <button type="submit"
                class="w-full p-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                Ajouter un medecin
            </button>
        </form>

    </div>
</body>

</html>