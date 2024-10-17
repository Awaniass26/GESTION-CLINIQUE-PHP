<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendezvous</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
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
                        <a href="<?= WEBROOT ?>/?controller=rendezvous&action=form-rendezvous" class="bg-green-600 text-white font-medium text-sm py-2 px-4 rounded hover:bg-green-700">Nouveau rendez-vous</a>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                new
                        </button>
                    </div>
                    <div class="overflow-x-auto">
                        <?php if (!empty($rendezvous)): ?>
                            <table class="min-w-full bg-white rounded-lg border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-700">
                                        <th class="py-2 px-4 border-b text-center">Id</th>
                                        <th class="py-2 px-4 border-b text-center">Date</th>
                                        <th class="py-2 px-4 border-b text-center">Statut</th>
                                        <th class="py-2 px-4 border-b text-center">Patient</th>
                                        <th class="py-2 px-4 border-b text-center">Medecin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rendezvous as $rendezvous): ?>
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-100 text-center">
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $rendezvous['id']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $rendezvous['date']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $rendezvous['statut']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $rendezvous['patient_nom'] . ' ' . $rendezvous['patient_prenom']; ?></td>
                                            <td class="px-6 py-4 text-gray-700 text-center"><?php echo $rendezvous['medecin_nom'] . ' ' . $rendezvous['medecin_prenom']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Aucun rendez-vous trouvé.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Sign in to our platform
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
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
        </div>
    </div>
</div> 
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>