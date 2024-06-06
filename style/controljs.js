

let formulaire1 = document.getElementById('Form');



formulaire1.addEventListener('submit', function(e) {


    let name = document.getElementById("nom");
    let regExNom = /^[a-zA-Z\s]+$/;
    let nomError = document.getElementById('erreurNom');
    
    let prenom = document.getElementById("prenom");
    let prenomError = document.getElementById('erreurPrenom');
    
    let cin = document.getElementById("cin");
    let regExCin = /^\d{8}$/;
    let cinError = document.getElementById('erreurCin');
    
    let mail = document.getElementById("email");
    let regExEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    let emailError = document.getElementById('erreurEmail');
    
    let password = document.getElementById("pwrd");
    let regExPword = /^[a-zA-Z0-9]{7,}[#$]$/;
    let pwordError = document.getElementById('erreurmotdepasse');
    
    let pseudo = document.getElementById("pseudo");
    let pseudoError = document.getElementById('erreur_pseudo');
    
    let numcom = document.getElementById("numero_registre_commerce");
    let regExCom = /^[A-Z]\d{10}$/;
    let comError = document.getElementById('erreurNumero_registre_commerce');
    
    let company = document.getElementById("nom_entreprise");
    let companyError = document.getElementById('erreurNom_entreprise');
    
    let adr = document.getElementById("adresse_entreprise");
    let adrError = document.getElementById('erreurAdresse_entreprise');
    
    let photo = document.getElementById("photo");
    let photoError = document.getElementById('erreur_photo');

// Contrôle de saisie du nom 
if (name.value.trim() == '') {
    nomError.textContent = 'Le champ nom est requis';
    e.preventDefault();
} else if (regExNom.test(name.value) == false) {
    nomError.textContent = "Le champ nom doit être composé de lettres ou d'espaces";
    e.preventDefault();
}
// Contrôle de saisie du prenom 
if (prenom.value.trim() == '') {
    prenomError.textContent = 'Le champ prénom est requis';
    e.preventDefault();
} else if (regExNom.test(prenom.value) == false) {
    prenomError.textContent = "Le champ prénom doit être composé de lettres ou d'espaces";
    e.preventDefault();
}
// Contrôle de saisie du pseudo 
if (pseudo.value.trim() == '') {
    pseudoError.textContent = 'Le champ pseudo est requis';
    e.preventDefault();
}
// Contrôle de saisie du cin
if (cin.value.trim() == '') {
    cinError.textContent = 'Le champ CIN est requis';
    e.preventDefault();
} else if (regExCin.test(cin.value) == false) {
    cinError.textContent = "Le champ CIN doit être composé de 8 chiffres";
    e.preventDefault();
}
//contrôle du mot de passe
if (password.value.trim() == '') {
    pwordError.textContent = 'Le champ mot de passe est requis';
    e.preventDefault();
} else if (regExPword.test(password.value) == false) {
    pwordError.textContent = "Le mot de passe doit être composé d'au moins 8 lettres ou chiffres et se terminer par le symbole $ ou #.";
    e.preventDefault();
}
//contrôle de l'email
if (mail.value.trim() == '') {
    emailError.textContent = 'Le champ e-mail est requis';
    e.preventDefault();
} else if (regExEmail.test(mail.value) == false) {
    emailError.textContent = "L'adresse e-mail est invalide";
    e.preventDefault();
}
//contrôle du numéro de registre de commerce
if (numcom.value.trim() == '') {
    comError.textContent = 'Le champ numéro de registre de commerce est requis';
    e.preventDefault();
} else if (regExCom.test(numcom.value) == false) {
    comError.textContent = "Le numéro de registre de commerce doit être composé d'une lettre majuscule suivie de 10 chiffres";
    e.preventDefault();
}
// Contrôle de saisie du nom de l'entreprise 
if (company.value.trim() == '') {
    companyError.textContent = 'Le champ nom de l\'entreprise est requis';
    e.preventDefault();
}
// Contrôle de saisie de l'adresse de l'entreprise 
if (adr.value.trim() == '') {
    adrError.textContent = 'Le champ adresse de l\'entreprise est requis';
    e.preventDefault();
}
// Vérifie si un fichier est sélectionné
if (!photo.files || photo.files.length === 0) {
    photoError.textContent = 'Veuillez sélectionner une photo';
    e.preventDefault();
}
});
