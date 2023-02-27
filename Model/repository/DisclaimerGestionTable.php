<?php
define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
include( MY_PLUGIN_PATH.'..\Entity\DisclaimerOptions.php');

class DisclaimerGestionTable{
    
    public function supprimerTable(){
        //$wpb sert à récupérer l'objet contenant les informations relatives à la base de données
        global $wpdb;
        $table_disclaimer = $wpdb->prefix.'disclaimer_options';
        $sql ="DROP TABLE $table_disclaimer";
        $wpdb->query($sql);
    }
    public function creerTable(){
        //instanciation de la classe DisclaimerOptions
        $message=new DisclaimerOptions();
        //on alimente l'objet message avec les valeurs par défaut grâce au setter (mutateur)
        $message->setMessageDisclaimer('Au regard de la loi européenne, vous devez nous confirmer que vous avez plus de 18 ans  pour visiter ce site?');
        $message->setRedirectionko('https://www.google.com/');
        
        global $wpdb;
        //création de la table
        $tableDisclaimer=$wpdb->prefix.'disclaimer_options';
        if ($wpdb->get_var("SHOW TABLES LIKE $tableDisclaimer") != $tableDisclaimer){
            $sql ="CREATE TABLE $tableDisclaimer (
                id_disclaimer INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                message_disclaimer TEXT NOT NULL,
                redirection_ko TEXT NOT NULL)
                ENGINE = InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
            ;
            //message d'erreur
            if(!$wpdb->query($sql)){
                die('Une erreur est survenue, contactez le développeur du plugin...');   
            }
            //Insertion du message par défaut du message
            $wpdb->insert(
                $wpdb->prefix.'disclaimer_options',
                array(
                    'message_disclaimer'=>$message->getMessageDisclaimer(),
                    'redirection_ko'=> $message->getRedirectionko(),
                ),
                array('%s','%s')
            );
            $wpdb->query($sql);
        }
    }
    function insererDansTable($contenu,$url){
        global $wpdb;
        $table_disclaimer=$wpdb->prefix.'disclaimer_options';
        $sql=$wpdb->prepare("
        UPDATE $table_disclaimer
        SET message_disclaimer = '%s',redirection_ko='%s' WHERE id_disclaimer=%s",$contenu,$url,1
        );
    $wpdb->query($sql);
    }
    function AfficherDonneModal(){
        global $wpdb;
        $query='SELECT * FROM '.$wpdb->prefix.'disclaimer_options';
        $row=$wpdb->get_row($query);
        $message_disclaimer = $row->message_disclaimer;
        $lien_redirection =  $row->redirection_ko;
        return '   <!-- Modal -->
          <div style="z-index: index 10000;" class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h2 style="color:red;margin:auto;text-align: center;" class="modal-title" id="staticBackdropLabel">DISCLAIMER</h2>
              </div>
              <div class="modal-body">
                <p>'.$message_disclaimer.'</p>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="'.$lien_redirection.'">J\'ai moins de 18 ans</a>
                <a type="button" id="cookie" class="btn btn-primary" data-dismiss="modal">J\'ai plus de 18 ans </a>
              </div>
            </div>
          </div>
        </div>';
    }
}
?>