<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>

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
    <div class="container mx-auto pt-6">
        <div class="flex flex-col">
            <div class="w-full bg-white rounded-lg shadow-md">
                <div class="bg-green-500 text-white font-bold text-center text-xl p-4 rounded-t-lg ">Liste des Patients</div>
                <div class="p-4">
                    <div class="mb-4 flex justify-end">
                        <a href="<?= WEBROOT ?>/?controller=patient&action=form-patient" class="bg-green-600 text-white font-medium text-sm py-2 px-4 rounded hover:bg-green-700">Nouveau</a>
                    </div>
                    <div class="overflow-x-auto">
                        <?php if (!empty($patients)): ?>
                            <table class="min-w-full bg-white rounded-lg border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700">
                                        <th class="py-2 px-4 border-b text-center">Id</th>
                                        <th class="py-2 px-4 border-b text-center">Nom</th>
                                        <th class="py-2 px-4 border-b text-center">Prenom</th>
                                        <th class="py-2 px-4 border-b text-center">Date de Naissance</th>
                                        <th class="py-2 px-4 border-b text-center">Adresse</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($patients as $patient): ?>
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 text-center">
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $patient['id']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $patient['nom']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $patient['prrenom']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $patient['date_naissance']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $patient['adresse']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Aucun patient trouvé.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>