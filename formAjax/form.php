<!DOCTYPE html>
<html>

<head>
    <title>Formulaire de Connexion Bootstrap</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome pour l'icône de profil -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSS personnalisé -->
    <style>
        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #e8e5e5;
            /* Couleur de fond légèrement grise */
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            
        }

        .form-signin {
            width: 900px;
            max-width: 1000px;
            padding: 25px 30px;
            margin-bottom: 20px;
            /* Ajout d'une marge en bas du formulaire */
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.533);
        }

        .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        /* Position de l'icône de fermeture */
        .close-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            /* Change le curseur en main lorsqu'il survole l'icône */
        }

        /* Styles pour le titre */
        .title-container {
            text-align: center;
            margin-bottom: 20px;
            /* Ajout d'une marge en bas du titre */
            padding: 15px;
            background-color: #e8e5e5;

        }

        
        
    </style>


</head>

<body>
    <div class="container form-container">
        <!-- Icône de fermeture -->
        <i id="closeIcon" class="fa fa-times-circle close-icon"></i>

        <form id="monFormulaire" class="form-signin" action="traitement.php" method="post">
            <div class="text-center mb-4">
                <i class="fa fa-user-circle fa-3x"></i>
                <h1 class="h3 mb-3 font-weight-normal">Inscription Agent</h1>
            </div>

            
            <div class="form-row">
  <div class="form-group col-md-6">
    <label for="nom" class="col-form-label">Nom:</label>
    <input type="text" id="nom" name="nom" class="form-control">
  </div>

  <div class="form-group col-md-6">
    <label for="whatsapp" class="col-form-label">WhatsApp:</label>
    <input type="text" id="whatsapp" name="whatsapp" class="form-control">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="etat" class="col-form-label">État:</label>
    <input type="text" id="etat" name="etat" class="form-control">
  </div>
  
  <div class="form-group col-md-6">
    <label for="login" class="col-form-label">Login:</label>
    <input type="text" id="login" name="login" class="form-control">
  </div>  
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="password" class="col-form-label">Password:</label>
    <input type="password" id="password" name="password" class="form-control">
  </div>

  
</div>
    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="select1" class="col-form-label">Ville:</label>
    <select id="select1" required>
      <!-- options -->
    </select>
  </div>

            <div class="form-group col-md-6">
                <label for="select2" required>Agence:</label>
        <select id="select2">
            <option selected="selected">Sélectionnez une agence</option>
            <!-- Options pour le deuxième select -->
        </select>
            </div>

            <div class="form-group col-md-6">
            <label for="libelleService">Service:</label>
        <select id="libelleService">
            <option selected="selected">Sélectionnez un service</option>
            <!-- Options pour le troisième select -->
        </select>
            </div>
    </div>
           
           
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">S'inscire</button>
        </form>

    </div>

    <table>
        <tr>
            <th></th>
        </tr>
    </table>

    <!-- JS Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Validation JavaScript -->
    <script>
        document.getElementById('monFormulaire').addEventListener('submit', function(e) {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Veuillez remplir tous les champs.');
                e.preventDefault(); // Empêche la soumission du formulaire
            }
        });

        $(document).ready(function() {
            // Chargement des options pour le premier select
            $.ajax({
                type: 'POST',
                url: 'fetch_data.php',
                data: {
                    option: 'initial',
                    type: 'ville'
                },
                success: function(response) {
                    var select1 = $("#select1");
                    var options = JSON.parse(response);
                    for (var i = 0; i < options.length; i++) {
                        select1.append(new Option(options[i].text, options[i].value));
                    }
                }
            });

            // Mise à jour des options pour le deuxième select lors de la sélection d'une option dans le premier select
            $("#select1").change(function() {
                var selectedOption = $(this).val();
                // Mise à jour du deuxième select (Agence)
                $.ajax({
                    type: 'POST',
                    url: 'fetch_data.php',
                    data: {
                        option: selectedOption,
                        type: 'agence'
                    },
                    success: function(response) {
                        var select2 = $("#select2");
                        select2.empty();
                        var options = JSON.parse(response);
                        for (var i = 0; i < options.length; i++) {
                            select2.append(new Option(options[i].text, options[i].value));
                        }
                    }
                });

                // Vider le troisième select (Service)
                $("#libelleService").empty();
            });

            // Mise à jour des options pour le troisième select lors de la sélection d'une option dans le deuxième select
            $("#select2").change(function() {
                var selectedOption = $(this).val();
                // Mise à jour du troisième select (Service)
                $.ajax({
                    type: 'POST',
                    url: 'fetch_data.php',
                    data: {
                        option: selectedOption,
                        type: 'service'
                    },
                    success: function(response) {
                        var libelleService = $("#libelleService");
                        libelleService.empty();
                        var options = JSON.parse(response);
                        for (var i = 0; i < options.length; i++) {
                            libelleService.append(new Option(options[i].text, options[i].value));
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>