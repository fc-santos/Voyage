$(document).ready(function () {
  $("#formEnregistrer").validate({
    errorElement: "span",
    rules: {
      prenom: {
        required: true,
      },
      nom: {
        required: true,
      },
      courriel: {
        required: true,
        email: true
      },
      mdp: {
        required: true,
        password: true,
        rangelength: [8, 12]
      },
      cmdp: {
        required: true,
        equalTo: "#mdp"
      },
      errorPlacement: function (error, element) {
        var name = $(element).attr("name");
        error.appendTo("#" + name + "-error");
      }
    },
    messages: {
      prenom: {
        require: "Veuillez indiquer votre prénom"
      },
      nom: {
        required: "Veuillez indiquer votre nom",
      },
      courriel: {
        email: "Le courriel doit être dans le format: abc@example.com"
      },
      mdp: {
        required: "Veuillez indiquer votre mot de passe",
        rangelength: "SVP choisir un mot de passe entre 8 et 12 caractères"
      },
      cmdp: {
        required: "Veuillez confirmer votre mot de passe",
        equalTo: "Le mot de passe et la confirmation du mot de passe ne correspondent pas"
      }
    }
  });
  $("#formConnecter").validate({
    errorElement: "span",
    rules: {
      courrielConnexion: {
        required: true,
        email: true
      },
      mdpConnexion: {
        required: true,
        password: true,
        rangelength: [8, 12]
      },
      errorPlacement: function (error, element) {
        var name = $(element).attr("name");
        error.appendTo("#" + name + "-error");
      }
    },
    messages: {
      courrielConnexion: {
        email: "Le courriel doit être dans le format: abc@example.com"
      },
      mdpConnexion: {
        required: "Veuillez indiquer votre mot de passe",
        rangelength: "SVP choisir un mot de passe entre 8 et 12 caractères"
      }
    }
  });
});