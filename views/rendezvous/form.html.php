<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Rendez-vous</title>
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
        <h2 class="text-center text-2xl font-bold text-green-500 mb-6">Nouveau Rendez-vous</h2>
        <form action="#" method="POST">
           
            <div class="form-group flex justify-between mb-4">
                <div class="left w-1/2 pr-2">
                    <label for="date" class="block text-black font-bold mb-2">Date</label>
                    <input type="date" id="date" placeholder="Entrez la date" required  name="date"
                        class="w-[95%] bg-white border border-gray-300 p-2 rounded">
                </div>
                <div class="right w-1/2 pl-2">
                    <label for="statut" class="block text-black font-bold mb-2">Statut</label>
                    <input type="text" id="statut" placeholder="Entrez le statut" required name="statut"
                        class="w-[95%] bg-white border border-gray-300 p-2 rounded">
                </div>
            </div>

            
            <div class="form-group flex justify-between mb-4">
                <div class="left w-1/2 pr-2">
                    <label for="patient" class="form-label font-bold">Patient</label>
                    <select name="patient_id" class="w-[95%] bg-white border border-gray-300 p-2 rounded" aria-label="Sélectionnez un patient" required>
                        <option value="" selected disabled >Choisissez un patient</option>
                        <?php foreach ($patients as $patient): ?>
                            <option value="<?= $patient['id'] ?>"><?= $patient['nom'] ?><?= $patient['prrenom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="right w-1/2 pl-2">
                    <label for="medecin" class="form-label font-bold">Medecin</label>
                    <select name="medecin_id" class="w-[95%] bg-white border border-gray-300 p-2 rounded" aria-label="Sélectionnez un medecin" required>
                        <option value="" selected disabled>Choisissez un medecin</option>
                        <?php foreach ($medecins as $medecin): ?>
                            <option value="<?= $medecin['id'] ?>"><?= $medecin['nom'] ?><?= $medecin['prenom'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="controller" value="rendezvous">
            <input type="hidden" name="action" value="add-rendezvous">
            <!-- Bouton -->
            <div class="bouton flex justify-center mt-6">
                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded">
                    Ajouter un Rendez-vous
                </button>
            </div>
        </form>
    </div>
</body>

</html>
