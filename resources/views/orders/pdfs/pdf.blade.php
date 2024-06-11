<!DOCTYPE html>
<html>
<head>
    <title>pdf</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <table style="width: 100%;">
        <tr>
            <td width="50%" style="text-align: center;"><img src="https://peep.ma/wp-content/uploads/2022/12/new-logo-peep.png" width="200" /></td>
            <td width="50%" style="text-align: center;"><img src="https://back.peep.ma/wafa.png" width="200" /></td>
        </tr>
    </table>
    <br />
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="font-size: 18px; text-align: center; font-weight: 700;">Parents d’Élèves des Établissements Publics Français au Maroc</td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td width="33%" style="font-size: 15px; text-align: center; font-weight: 400;">Site Web : www.peep.ma</td>
            <td width="33%" style="font-size: 15px; text-align: center; font-weight: 400;">E-mail : peep@peep.ma</td>
            <td width="33%" style="font-size: 15px; text-align: center; font-weight: 400;">Facebook : peepmaroc</td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="font-size: 22px; text-align: center; font-weight: 600;">BULLETIN D’ADHESION</td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="font-size: 17px; text-align: center; font-weight: 600;">
                ATTESTATION D’ASSURANCE 2023/2024 N° {{ $order->code }}
            </td>
        </tr>
    </table>
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="font-size: 14px; text-align: center; font-weight: 400;">En cas d’accident, merci de contacter le 06 63 64 27 13</td>
        </tr>
    </table>
    <p>Il est certifié et attesté que :</p>
    @foreach($order->enfants as $enfant)
    <table style="width: 100%;" border="1">
        <tr>
            <td width="100%" style="font-size: 14px; text-align: center; font-weight: 400;">Nom et Prénom de l'élève: <b>{{ $enfant['nom'] }} {{ $enfant['prenom'] }}</b></td>
        </tr>
        <tr>
            <table style="width: 100%;">
                <tr>
                    <td width="50%" style="text-align: center;">Établissement : <b>{{ $enfant->ecole->name, $order->id }}</b></td>
                    <td width="50%" style="text-align: center;">Classe : <b>{{ $enfant->class->name, $order->id }}</b></td>
                </tr>
                <tr>
                    <td width="50%" style="text-align: center;">Assurance Scolaire: <b>{{ $order->school_insurance ?? 0 }} Dhs</b></td>
                    <td width="50%" style="text-align: center;">Assurance frais de Scolarité : <b>{{ $order->tution_fee_insurance ?? 0 }} Dhs</b></td>
                </tr>
            </table>
        </tr>
    </table>
    <br>
    @endforeach
    <p>
        est assuré en RESPONSABILITE CIVILE ET INDEMNITES CONTRACTUELLES en vertu du contrat d'assurance N°18-47081 souscrit par la PEEP auprès de "Wafa Assurance" du: 01 Septembre 2023 au 31 Août 2024.
    </p>
    <br />
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="padding-bottom: 10px; font-size: 17px; text-align: center; font-weight: 600;">INFORMATIONS CONTACTS</td>
        </tr>
    </table>
    <table style="width: 100%;" border="1">
        <tr>
            <td width="50%" style="text-align: center;">Nom et prénom responsable : <b>{{ $order->parent_nom }} {{ $order->parent_prenom }}</b></td>
            <td width="50%" style="text-align: center;">Email : <b>{{ $order->email }}</b></td>
        </tr>
        <tr>
            <td width="50%" style="text-align: center;">Rôle : <b>{{ $order->parent_role }}</b></td>
            <td width="50%" style="text-align: center;">Téléphone : <b>{{ $order->parent_telephone }}</b></td>
        </tr>
    </table>
    <br />
    <table style="width: 100%;">
        <tr>
            <td width="100%" style="padding-bottom: 10px; font-size: 17px; text-align: center; font-weight: 600;">ADHESION & CONTRIBUTION</td>
        </tr>
    </table>
    <table style="width: 100%; border=1px">
        <tr>
            <td width="50%" style="text-align: center;">Adhesion : <b>{{ $order->adhesion ?? 0 }} Dhs</b></td>
            <td width="50%" style="text-align: center;">Contribution : <b>{{ $order->contribution ?? 0}} Dhs</b></td>
        </tr>
    </table>
    <br />
    <table style="width: 100%; border:1px">
        <tr>
            <td width="100%" style="padding-left: 10px; padding-right: 10px; padding-top: 15px; padding-bottom: 15px; text-align: center;">NONTANT TOTAL REGLE : <b> {{ $order->total_amount }}  Dhs</b></td>
        </tr>
    </table>
    <p>NB : Les parents déclarent avoir pris connaissance des garanties du contrat d‘assurance scolaire figurant en deuxième page de
        <p />
        <p>Fait à casablanca Le :<b> {{ $order->created_at }}</b></p>

<div style="page-break-after: always;"></div>

<table style="width: 100%;">
    <tr>
        <td width="100%" style="font-size: 18px; text-align: center; font-weight: 700;">LA GARANTIE D'UNE GRANDE COMPAGNIE D'ASSURANCE</td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td width="100%" style="font-size: 16px; text-align: center; font-weight: 500;">L'ASSURANCE SCOLAIRE ET EXTRA SCOLAIRE DE LA PEEP</td>
    </tr>
</table>
<table style="width: 100%;">
    <tr>
        <td width="100%" style="font-size: 16px; text-align: center; font-weight: 500;">COUVRE LES DIFFERENTS RISQUES CI-APRES:</td>
    </tr>
</table>
            </br>
            <p style="font-size: 13px;font-weight: 300;">{{ __('messages.pdf_assurance.pdf_I_ASSURANCE') }}:</p>
            <p style="font-size: 11px;">{!! __('messages.pdf_assurance.pdf_assurance_content') !!}</p>
<p style="font-size: 13px; text-align: center; font-weight: 300;">{{ __('messages.pdf_assurance_exclusions.pdf_Elle_s') }}</p>
<p style="font-size: 11px;"><strong>{{ __('messages.pdf_assurance_exclusions.pdf_intoxications_alimentaires') }}</strong></br>
    {{ __('messages.pdf_assurance_exclusions.pdf_intoxications_alimentaires_content') }}</br>
    {{ __('messages.pdf_assurance_exclusions.pdf_domages_materiels_incendie') }}</br>
    {{ __('messages.pdf_assurance_exclusions.pdf_degats_des_eaux') }}</br>
    {{ __('messages.pdf_assurance_exclusions.pdf_defenses_recours') }}</p>
<p style="font-size: 13px;font-weight: 300;">II-INDEMNITES CONTRACTUELLES :</p>
<p style="font-size: 11px;">Si la garantie "Responsabilité Civile" n'est pas appelée à jouer, le contrat garantit également aux élèves des Indemnités
forfaitaires prévues, en cas de lésion corporelle les atteignant et ayant sa cause dans un accident, c'est-à-dire toute
atteinte corporelle non intentionnelle de la part de la victime et provenant de l'action soudaine d'une cause extérieure.</br>
a) <strong>DECES:</strong>
En cas de décès de la victime survenant dans un délai d'un an à compter de l'accident, la Compagnie palera le capital prévu
aux ayants droit de la victime, dans les 30 jours de la remise à la Compagnie des pièces justificatives.</br>
b) <strong>INFIRMITES PERMANENTES :</strong></br>
La Compagnie palera à la victime dès que l'incapacité est consolidée, l'indemnité fixée réductible dans la limite du degré
d'invalidité définitive évalué suivant le barème.</br>
c)  <strong>FRAIS MEDICAUX, CHIRURGICAUX, PHARMACEUTIQUES ET D'HOSPITALISATION </strong>:</br>
La Compagnie remboursera les frais effectivement engagés par la victime déduction falte de la partie de ces frais
remboursables soit par un organisme de Sécurité sociale soit au titre d'une assurance collective ou individuelle.</br>
Sont également garantis dans la limite de maximum prévu les frais de transport à l'établissement hospitalier le plus proche.</br>
• <strong>FRAIS DE PROTHESE DENTAIRE:</strong></br>
Sont compris dans la garantis à concurrence du montant Indiqué.</br>
• <strong>BRIS DE LUNETTES:</strong></br>
Le bris des lunettes par suite d'accident est remboursable une fois par année d'assurance.</p>

<p style="font-size: 13px;font-weight: 300;">EXCLUSION</P>
<p style="font-size: 11px;"><strong>A - RESPONSABILITE CIVILE:</strong>
Véhicules à moteurs soumis à l'assurance obligatoire - Les chevaux et voitures</br>
<strong>B-INDIVIDUELLE ACCIDENTS:</strong>
Sports dangereux pratiqués en tant que professionnel.</br>
En cas d'accident le dossier d'assurance doit nécessairement contenir :</br>
• Une déclaration d'accident sur Imprimé "Etablissement" ou Imprimé "PEEP" pour accident en dehors de l'Etablissement.</br>
• Un certificat de constatation établi par un médecin.</br>
• Les justificatifs des frais engagés (originaux):</br>
- Ordonnances</br>
- Prospectus des médicaments</br>
-Radios s'il y a lieu</br>
- Factures acquittées (pharmacie, honoraires etc...)</br>
- Un certificat de guérison avec Indication de l'IPP s'il y a lieu</p>
            </br>
<table style="width: 100%;" border="1">
    <tr>
        <td width="100%" style="padding-left: 10px; padding-right: 10px; padding-top: 15px; padding-bottom: 15px; text-align: center;">L'Adhérent doit s'abstenir d'introduire lui-même toute action en justice.
Dans le cas contraire, les frais et conséquences de cette action resteront à sa charge.</td>
    </tr>
</table>
</body>
</html>
