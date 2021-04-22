$('document').ready(function(){
    // ispisivanje kategorija
    ispisiKategorije();

    //registracija
    $('#dugme').on("click",registracija);

    //logovanje
    $("#dugme1").on("click",logovanje);

    // vote
    $("#dgmVote").on("click",glasanje);

    //komentarisanje
    $("#dugme-komentar").on("click",komentarisanje);

    // popunjavanje drop-down liste za graditeje
    ddlBuilders();

    // popunjavanje forme za update
    $(".dgmUp").on("click",popuniFormu);

    // provera fomre za update, i prosledjivanje podataka
    $("#update-dugme").on("click",updateZgrade);

    //brisanje zgrada
    $(".dgmDelete").on("click",brisanjeZgrade);

    // brisanje komentara
    $(".komDelete").on("click",brisanjeKomentara);

    //brisanje korisnika
    $(".userDelete").on("click",brisanjeKorisnika);

    //brisanje navigacije
    $(".navDelete").on("click",deleteNav);

    //popuni update za navigaciju
    $(".updateNav").on("click",fillNavUpdate);

    //update navigacije
    $(".navIzmena").on("click",updateNavigation);

    // provera forme za insert na klijentu
    $("#forma-insert").submit(function(e){
    let insert_price = $('#insert-price').val();
    let insert_name = $('#insert-name').val();
    let insert_location = $('#insert-location').val();
    let longtxt1 = $('#infoDug1').val();
    let proveraCene = /^[0-9]{1,10}.00$/;
    let proveraIme = /^[A-ZĐŠŽĆČa-zđšžćč0-9\s]{2,29}$/;
    let proveraLokacije = /^[A-ZĐŠŽĆČ][a-zđšžćč]{1,40},\s{0,1}[A-ZĐŠŽĆČ][a-zđšžćč]{1,40}$/;
    let proveraInfo = /^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\\\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/;
    let greskice = [];
    if(!(proveraCene.test(insert_price))){
        $('#insert-price').css({border:'1px solid red'});
        greskice.push("Price is invalid");
    }
    if(!(proveraIme.test(insert_name))){
        $('#insert-name').css({border:'1px solid red'});
        greskice.push("Name is invalid");
    }
    if(!(proveraLokacije.test(insert_location))){
        $('#insert-location').css({border:'1px solid red'});
        greskice.push("Location is invalid");
    }
    if(!(proveraInfo.test(longtxt1))){
        $('#infoDug1').css({border:'1px solid red'});
        greskice.push("Long info is invalid");
    }
    if(greskice.length){
        for(let greska of greskice){
            alert(greska);
        }
        event.preventDefault();
        e.preventDefault();
        return false;
    }
    else{
        return true;
    }
    });

});

// Ispisi kategorije
function ispisiKategorije(){
    $.ajax({
        url:'models/kategorije/getcategory.php',
        type:'post',
        data:{
            uspelo:true
        },
        dataType:'json',
        success: function(data){
            let ispis = ``;
            let ispis2 = ``;
            data.forEach(function(el){
                ispis+=`
                <a href="#" class="list-group-item kat" data-id="${el.categoryId}">${el.categoryName}</a>
                `;
                ispis2 += `
                <option value="${el.categoryId}">${el.categoryName}</option>
                `;
            });
            $('#ddl-update1').html(ispis2);
            $('#ddl-insert1').html(ispis2);
            $('#kategorije').html(ispis);
            $('.kat').on('click',function(e){
                e.preventDefault();
                let id = this.dataset.id;
                $.ajax({
                    url:'models/zgrade/filterbuildings.php?id='+id,
                    type:'get',
                    dataType:'json',
                    success:function(data){
                        ispisiZgrade(data);
                    },
                    error:function(xhr,status,error){
                        if(xhr.status == 404){
                            console.log("There are no buildings in this category");
                        }
                    }
                })
            });
        },
        error:function(xhr,status,error){
            console.log(xhr.responseText);
        }
    });
}

// Funkcija za registraciju
function registracija(){
    let imeVrednost = $('#ime1').val();
        let prezimeVrednost = $('#prezime1').val();
        let usernameVrednost = $('#username1').val();
        let emailVrednost = $('#mail1').val();
        let sifraVrednost = $('#sifra1').val();
        let ponoviSifru = $('#sifra2').val();
        let greske = [];
        let proveraTekst = /^[A-ZĐŠŽĆČ][a-zđšžćč]{1,21}$/;
        let proveraUsername = /^[A-ZĐŠŽĆČa-zđšžćč0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
        let proveraMail = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
        let proveraaSifre = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,21}$/;
        if(proveraTekst.test(imeVrednost)){
            $('#ime1').css({border:"1px solid green"});
        }
        else{
            $('#ime1').css({border:"1px solid red"});
            greske.push("Name is invalid");
        }
        if(proveraTekst.test(prezimeVrednost)){
            $('#prezime1').css({border:"1px solid green"});
        }
        else{
            $('#prezime1').css({border:"1px solid red"});
            greske.push("Surname is invalid");
        }
        if(proveraUsername.test(usernameVrednost)){
            $('#username1').css({border:"1px solid green"});
        }
        else{
            $('#username1').css({border:"1px solid red"});
            greske.push("Username is invalid");
        }
        if(proveraMail.test(emailVrednost)){
            $('#mail1').css({border:"1px solid green"});
        }
        else{
            $('#mail1').css({border:"1px solid red"});
            greske.push("Mail is invalid");
        }
        if(proveraaSifre.test(sifraVrednost)){
            $('#sifra1').css({border:"1px solid green"});
        }
        else{
            $('#sifra1').css({border:"1px solid red"});
            greske.push("Password is invalid");
        }
        if(sifraVrednost == ponoviSifru){
            $('#sifra2').css({border:"1px solid green"});
        }
        else{
            $('#sifra2').css({border:"1px solid red"});
            greske.push("Passwords don't match");
        }
        if(greske.length){
            for(let gres of greske){
                alert(gres);
            }
        }
        else{
            $.ajax({
                url:'models/korisnik/registracija.php',
                type:'post',
                data:{
                    ime:imeVrednost,
                    prezime:prezimeVrednost,
                    username:usernameVrednost,
                    mail:emailVrednost,
                    sifra:sifraVrednost,
                    sifraopet:ponoviSifru,
                    stiglo:true
                },
                success: function(data){
                    alert(data);
                    if(data == 'Registered successfully, head over to the LogIn page'){
                        location.replace('http://praktipumphp.epizy.com/index.php?page=login');
                    }
                },
                error:function(error,status,xhr){
                    let message = "Error";
                    switch(xhr.status){
                        case 404:
                            message = "Page not found";
                            break;
                        case 409:
                            message = "Username or email exists";
                            break;
                        case 422:
                            message = "Not valid";
                            break;       
                        case 500:
                            message = "Server is experiencing some errors, please try again later";
                            break; 
                    }
                    alert(message);
                }
            })
        }
}

// Funkcija za logovanje
function logovanje(){
    let usernameVrednost = $('#username2').val();
    let sifraVrednost = $('#sifra3').val();
    let proveraUsername = /^[A-ZĐŠŽĆČa-zđšžćč0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
    let proveraaSifre = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,21}$/;
    let greske = [];
    if(proveraUsername.test(usernameVrednost)){
    }
    else{
        $('#username2').css({border:"1px solid red"});
        greske.push("malo greska");
    }
    if(proveraaSifre.test(sifraVrednost)){  
    }
    else{
        $('#sifra3').css({border:"1px solid red"});
        greske.push("malo greska");
    }
    if(greske.length){
        alert("Make sure your incredentials are correct");
    }
    else{
        // LOGOVANJE
        $.ajax({
            url:'models/korisnik/logovanje.php',
            type:'post',
            dataType:'json',
            data:{
                username:usernameVrednost,
                sifra:sifraVrednost,
                stiglo:true
            },
            success:function(data){
                if(data == "Username or password is invalid"){
                    alert(data);
                }
                if(data.role == "admin"){
                    location.replace('http://praktipumphp.epizy.com/index.php?page=admin');
                }
                else{
                    location.replace('http://praktipumphp.epizy.com/index.php?page=question');
                }
            },
            error:function(error,status,xhr){
                let message = "Make sure your credentials are correct";
                switch(xhr.status){
                    case 404:
                        message = "Page not found";
                        break;
                    case 409:
                        message = "Username or email exists";
                        break;
                    case 422:
                        message = "Not valid";
                        break;       
                    case 500:
                        message = "Server is experiencing some errors, please try again later";
                        break; 
                }
                alert(message);
            }

        });
    }
}
//Funkcija za upisivanje rezultata ankete
function glasanje(){
    ddl_vote = $('#ddl-vote').val();
        $.ajax({
            url:"models/korisnik/vote.php",
            type:'post',
            data:{
                stiglo:true,
                vote:ddl_vote
            },
            success:function(data){
                alert(data);
                location.replace('http://praktipumphp.epizy.com/index.php');
            },
            error: function(err, error, xhr){
                console.log(err);
            }
        });
}
//Funkcija za popunjavanje forme za update navigacije
function fillNavUpdate(){
    let id = this.dataset.id;
    $.ajax({
        url:'models/admin/navigation/getspecif.php',
        type:"post",
        dataType: 'json',
        data: {
            id:id,
            stiglo:true
        },
        success:function(data){
            data.forEach(function(e){
                $("#nav-value").val(e.name);
                $("#nav-href").val(e.href);
                $(".sakriveno1").val(e.id);
            });
        },
        error:function(xhr){
            console.log(xhr.responseText);
        }
    });
}
// Funkcija za update Navigacije
function updateNavigation(){
    let id = $(".sakriveno1").val();
    console.log(id);
    let value = $("#nav-value").val();
    let href =$("#nav-href").val();
    let value_regex = /^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,32}$/;
    let href_regex = /^[a-zA-Z0-9.\/?&=]{6,99}$/;
    let greske = [];
    if(!(value_regex.test(value))){
        $('#nav-value').css({border:'1px solid red'});
        greske.push("Value is invalid");
    }
    if(!(href_regex.test(href))){
        $('#nav-href').css({border:'1px solid red'});
        greske.push("Href is invalid");
    }
    if(greske.length){
         greske.forEach(function(el){
            alert(el);
         });
    }
    else{
        $.ajax({
            url:"models/admin/navigation/updatenavigation.php",
            type:"POST",
            data:{
                stiglo:true,
                value:value,
                href:href,
                id:id
            },
            success:function(data){
                if(data == "Successfully updated"){
                    alert(data);
                    location.reload();
                }
            },
            error:function(xhr){
                if(xhr.status == 404){
                    alert("Error");
                }
                console.log(xhr.responseText);
            }   
        })
    }
    
}
// Funkcija za komentarisanje
function komentarisanje(){
    let id = this.dataset.id;
        let komentarVrednost = $('#komentar').val();
        let proveraKomentar = /^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\\\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/;
        if(proveraKomentar.test(komentarVrednost)){
            $('#komentar').css({border:"1px solid green"});
            $.ajax({
                url:'models/komentari/upiskomentara.php',
                type:'post',
                data:{
                    zgradaId:id,
                    komentar:komentarVrednost,
                    stiglo:true
                },
                success:function(data){
                    alert(data);
                    if(data == "Successfully commented, please refresh page"){
                        location.reload();
                    }
                    
                },
                error:function(error){
                    console.log(error);
                }
            })
        }
        else{
            $('#komentar').css({border:"1px solid red"});
        }
}
// Funkcija za dohvatanje graditelja
function ddlBuilders(){
    $.ajax({
        url:"models/graditelji/graditelji.php",
        dataType:'json',
        success:function(data){
            let ispis = ``;
            data.forEach(function(el){
                ispis +=`
                    <option value="${el.id}">${el.name}</option>`;
            });
            $('#ddl-update').html(ispis);
            $('#ddl-insert').html(ispis);
        },
        error:function(xhr,status){
            console.log(xhr);
        }
    });
}
// Delete Navigacije
function deleteNav(){
    let id = this.dataset.id;
    $.ajax({
        url:'models/admin/navigation/deleteNavigation.php',
        type:'post',
        data:{
            id:id,
            stiglo:true
        },
        success:function(data){
            if(data == "Successfully delted"){
                alert(data);
                location.reload();
            }
            else{
                console.log(data);
            }
        },
        error:function(xhr){
            console.log(xhr.responseText);
        }
    });
}
// Funkcija za popunjavanje forme za UPDATE zgrade
function popuniFormu(){
    let id = this.dataset.id;
        $.ajax({
            url:'models/admin/buildings/popuniupdate.php',
            type:'POST',
            dataType:"json",
            data:{
                id:id,
                stiglo:true
            },
            success:function(data){
                    $('#ddl-update').val(data.gradid);
                    $('#ddl-update1').val(data.katid);
                    $('#update-name').val(data.ime);
                    $('#update-price').val(data.cena);
                    $('#update-location').val(data.lokacija);
                    $('#infoDug').val(data.duzi);
                    $('#ddl-update2').val(data.konst);
                    $('#sakriveno').val(id);
            },
            error:function(xhr,error){

            }
        })
}

// Update zgrade
function updateZgrade(){
    let id = $('#sakriveno').val();
        let ddl_update = $('#ddl-update').val();
        let ddl_update1 = $('#ddl-update1').val();
        let update_price = $('#update-price').val();
        let update_name = $('#update-name').val();
        let update_location = $('#update-location').val();
        let ddl_update2 = $('#ddl-update2').val();
        let longtxt = $('#infoDug').val();
        let proveraCene = /^[0-9]{1,10}.00$/;
        let proveraIme = /^[A-ZĐŠŽĆČa-zđšžćč0-9\s]{2,29}$/;
        let proveraLokacije = /^[A-ZĐŠŽĆČ][a-zđšžćč]{1,40},\s{0,1}[A-ZĐŠŽĆČ][a-zđšžćč]{1,40}$/;
        let proveraInfo = /^[a-zđšžćčA-ZĐŠŽĆČ.,;!?:'\%\\\-\.]{1,} [a-zđšžćčA-ZĐŠŽĆČ.,:?;!]{1,} .+$/;
        let greskice = [];
        if(!(proveraCene.test(update_price))){
            $('#update-price').css({border:'1px solid red'});
            greskice.push("Price is invalid");
        }
        if(!(proveraLokacije.test(update_location))){
            $('#update-location').css({border:'1px solid red'});
            greskice.push("Location is invalid");
        }
        if(!(proveraIme.test(update_name))){
            $('#update-name').css({border:'1px solid red'});
            greskice.push("Name is invalid");
        }
        if(!(proveraInfo.test(longtxt))){
            $('#infoDug').css({border:'1px solid red'});
            greskice.push("Long info is invalid");
        }
        if(greskice.length){
            for(let greska of greskice){
                alert(greska);
            }
        }
        else{
            $.ajax({
                url:'models/admin/buildings/updatezgrade.php',
                type:"post",
                data:{
                    stiglo:true,
                    gradid:ddl_update,
                    katid:ddl_update1,
                    ime:update_name,
                    cena:update_price,
                    lokacija:update_location,
                    longtxt:longtxt,
                    konst:ddl_update2,
                    id:id
                },
                success:function(data){
                    alert(data);
                    if(data =="Updated successfully"){
                        location.reload();
                    }
                },
                error:function(xhr,status,error){
                    let message = "Error";
                    switch(xhr.status){
                        case 404:
                            message = "Page not found";
                            break;
                        case 409:
                            message = "Something went worng";
                            break;
                        case 422:
                            message = "Not valid";
                            break;       
                        case 500:
                            message = "Server is experiencing some errors, please try again later";
                            break; 
                    }
                    alert(message);
                }
            });
        }
}
// Brisanje zgrada
function brisanjeZgrade(){
    let id = this.dataset.id;
        $.ajax({
            url:'models/admin/buildings/deletebuilding.php',
            type:'post',
            data:{
                stiglo:true,
                id:id
            },
            success:function(data){
                alert(data);
                if(data == "Building deleted successfully"){
                    location.reload();
                }
            },
            error(xhr,err,error){
                alert(xhr.responseText);
            }
        });
}

// brisanje komentara
function brisanjeKomentara(){
    let id = this.dataset.id;
        $.ajax({
            url:'models/admin/comments/deletecomm.php',
            type:'post',
            data:{
                stiglo:true,
                id:id
            },
            success: function(data){
                alert(data);
                if(data == "Comment deleted successfully"){
                    location.reload();  
                }
            },
            error(xhr,err,error){
                console.log(xhr.responseText);
            }

        });
}
// brisanje korisnika
    function brisanjeKorisnika(){
        let id = this.dataset.id;
        $.ajax({
            url:'models/admin/users/deleteuser.php',
            type:'post',
            data:{
                stiglo:true,
                id:id
            },
            success: function(data){
                alert(data);
                if(data == "User deleted successfully"){
                    location.reload();  
                }
            },
            error(xhr,err,error){
                console.log(error);
            }
        });
    }
// Funkcija za ispisivanje zgrada
    function ispisiZgrade(data){
        let ispis = ``;
                data.forEach(function(el){
                    ispis+=`
                    <div class="col-lg-4 col-md-6 mb-4 buildings">
                    <div class="card h-100">
                      <a href="index.php?page=building&&id=${el.id}"><img class="card-img-top" src="assets/img/${el.src}" alt="${el.alt}"></a>
                      <div class="card-body">
                        <h4 class="card-title">
                          <a href="index.php?page=building&&id=${el.id}" data-id="${el.id}">${el.name}</a>
                        </h4>
                        <h5>$${el.price}</h5>
                        <p class="card-text">${el.sinfo}</p>
                      </div>
                      <div class="card-footer">
                      <a href="index.php?page=building&&id=${el.id}" data-id="${el.id}">More info -></a>
                      </div>
                    </div>
                  </div>     
                    `;
                });
                $('#zgrade').html(ispis);
    }
