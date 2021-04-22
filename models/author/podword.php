<?php
// try {
//     $word = new COM("word.application");
//     $word->Visible = true;
//     $word->Documents->Add();
//     $word->Selection->TypeText("Sasa Pajovic\n");
//     $word->Selection->TypeText("Opste informacije o meni: Profesorka, verujte mi da mi word ne radi ni na localhostu, a boze moj tek na hostingu, tako da vam skratim muke odmah vi tu jedan minus.");
//     $word->Documents[1]->SaveAs("author.doc");
//     $word->Quit();
//     $word = null;
//     unset($word);
//     header("Location: ../../index.php?page=author");
// } 
// catch (Exception $th) {
//     echo $th->getMessage();
// }
header("Content-type: application/vnd.ms-word");
 header("Content-Disposition: attachment;Filename=autor.doc");
 echo "<html>";
 echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows1252\">";
 echo "<body>";
 echo "<b>Autor</b>";
 echo "<p>Moje ime je Sasa Pajovic, i nadam se da ovo napokon radi vise.</p>";
 echo "</body>";
 echo "</html>";
?>