
function type_video()
      {
        if(document.getElementById("upload").checked)
        {
          $('#video_yt').css('display','none');
          $('#video_upload').css('display','');
        }
        if(document.getElementById("youtube").checked)
        {
          $('#video_yt').css('display','');
          $('#video_upload').css('display','none');
        }
      }

function verification_type_vente(object)
      {
          if(document.getElementById("enchere").checked && document.getElementById("meilleure_offre").checked)
          {
            if(object.id=="enchere")
            {
                document.getElementById("meilleure_offre").checked=false;
            }
            if(object.id=="meilleure_offre")
            {
                document.getElementById("enchere").checked=false;
            }
            alert("Votre objet ne peut être à la fois mis en vente par enchère et par meilleure offre !!!");
          }
          if(!document.getElementById("enchere").checked)
          {
            $('#date_fin').css('display', 'none');
          }
          else
          {
            $('#date_fin').css('display', '');
          }
      }
      
 function verification_formulaire()
      {
        enchere=document.getElementById("enchere").checked;
        meilleure_offre=document.getElementById("meilleure_offre").checked;
        achat_immediat=document.getElementById("achat_immediat").checked;
        date=
        erreur="";
        if(!meilleure_offre && !achat_immediat && !enchere)
        {
          erreur+="Merci de mettre un/des types d'achats pour votre objet.\n";
        }
        if(erreur!="")
        {
          alert(erreur);
        }
      }
var i=2;
function ajout_input_image()
 { 
    $('#photo_'+i).css('display', '');
    $('#photo_'+i).attr('disabled', false);
    if(i==2)
      $('#a_la_ligne').css('display', '');
    i++; verification_nb_input_image();
    
 }
function suppression_input_image()
 {  
    $('#photo_'+i).css('display', 'none');
    $('#photo_'+i).attr('disabled', true);
    if(i==2)
      $('#a_la_ligne').css('display', 'none');
    i--;verification_nb_input_image(i);
    
 }
function verification_nb_input_image()
{
  if(i<=2)
    i=2;
  if(i>=3)
    i=3;
}
