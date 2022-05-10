


 <?php

include("bar_de_menu.php");

 ?>
<div class="container-fluid">
<div class="contact">
<div class="container">
    
    <div class="headtext">
        <h2 class="ui left floated header">My Doctor Home <small>la médécine à la maison</small></h2>
        <div class="ui clearing divider"></div>
    </div>
        
    <div class="headtextt">
        	<h2 >Nous contacter</h2>
    </div>
       
       <div class="contact_content">
       		<form class="contact_form">
              <div class="col-lg-12">
                    <div class="">
                    	<input type="text" id="nom" class="contact_input" placeholder="Votre Nom">
                    </div>
               
                    <div class="">
                      <input id="mail"  name="mail" type="email"  class="contact_input" placeholder="Votre Nom">
                    </div>
                
                        <select class="contact_input">
                            <option selected>Votre Pays</option>
                            <option>France</option>
                            <option>Suisse</option>
                            <option>Italie</option>
                            <option>Espagne</option>
                        </select>
                
                    <div class="">
                    	<textarea id="message" name="message" class="contact_input contact_textarea" placeholder="Votre Message"></textarea>
                    </div> 
                </div> 
                
                <div class="col-lg-12"> 
                     <label class="radio">
                        <input type="radio" name="radios" id="radios1" value="option1" checked>
                        Je veux m'inscrire à la newsletter
                     </label>
               
                     <label class="radio">
                        <input type="radio" name="radios" id="radios2" value="option2">
                        Je ne veux pas m'inscrire à la newsletter
                     </label>
                
                <div class="">
                <a href="mailto:dv.balenvokolo@gmail.com"><button type="submit" class="contact_button btn-small" style="color:white">
<i class="icon-user icon-white"></i> Envoyer</button></a>
                   <button type="button" class="contact_buttonx btn-small">Annuler</button>
                </div>
                </div>
                
            </form>
        </div>
        </div>
        </div>
           
       <div class="container">
       		<address>
            	<strong>MyDoctorHome</strong>
                <br>
                069H, CITE SCHELTER
                <br>
                Congo, Brazzaville
                <abbr title="téléphone">Tél.</abbr> 069176545
            </address>
             
            <p >

            <a href="http://facebook.com"><i class="fa fa-facebook"  id="con"  title="cliquez pour nous contacter par facebook"></i></a>
            <a href="http://whatssapp.com"><i class="fa fa-whatsapp" id="con" title="cliquez pour nous contacter par whatsapp"></i></a>
            <a href="http://twitter.com"><i class="fa fa-twitter"  id="con" title="cliquez pour nous contacter par twitter"></i></a>
            <a href="http://skype.com"><i class="fa fa-skype" id="con" title="cliquez pour nous contacter par skype"></i></a>

            </p>

        </div>
       
    </div>
<br>
<br>
<br>
<br>
<br>

     <?php

include("pied.php");
     ?>

<!-- js -->
<script src="js/jquery-latest.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
