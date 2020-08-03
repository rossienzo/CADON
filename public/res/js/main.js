//Script
$(document).ready(function() {
 
    /**
     * Index 
     */

    $(document).on('click', 'ul li', function () {  
       $(this).addClass('active').removeClass('active');
    });

    /***********************
     *** Page - Index ******
    * - Scroll Top 
    */
    $("#nav-top").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    /***********************
     *** Page - Register ******
    * - Agree Terms
    */
    // id do checkbox
    
    let checkbox =  document.getElementById("agreeTerms");

    $("#checkbox").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });


    /***********************
     *** Page - recover-password ******
    * - Timer ao atualizar a senha
    */

    // verifica se o id existe
    if ($("#timer").length)
    { 
        let boldTimer =  document.getElementById("timer");
        var counter = 3;
        boldTimer.innerHTML =  "3";
        var interval = setInterval(function() {

            counter--;
            boldTimer.innerHTML =  counter;
            // Display 'counter' wherever you want to display it.
            if (counter == 0) {
                // Display a login box
                clearInterval(interval);
                boldTimer.innerHTML =  "0";
            }
        }, 1000);
    }
  

    /***********************
     *** App - Tarefas Pendentes ******
    * - Show Date Register Task
    */

    // Pega o elemento description do td
    try 
    {
        var lines = document.getElementById("tasks-group").getElementsByClassName('description');

            for (var i=0; i<lines.length; i++) {
                
                lines[i].addEventListener('click', dtRegeisterDisplay, false);
                
            }
    }
    catch (err)
    {
        //console.log('');
    }
    
    

    function dtRegeisterDisplay() 
    {
       
        dtRegister = this.children[2] // pega o atributo small
        
        if (dtRegister.style.display === "none") {
            dtRegister.style.display = "block";
        } 
        else 
        {
            dtRegister.style.display = "none";
        }
    }

});

/**
 * Index functions
 */


// forgot-password on send email 
// => Timer

function myTimer() {
  var d = new Date();
  document.getElementById("timer").innerHTML = d.toLocaleTimeString();
}



/**
 * Application functions
 */

// #Functions# \\

/**
 * Cria um input para editar a tarefa
 * @param {int} id 
 * @param {String} destask 
 */
function editTask(id, destask)
   {
       // cria o formulário de ediação
       let form = document.createElement('form')
       form.action = document.URL // manda para a url atual em forma de post
       form.method = 'post'
       form.id = 'form-edit'
       form.className = 'row'
       

       // cria um input 
       let inputTarefa = document.createElement('input')
       inputTarefa.type = 'text'
       inputTarefa.name = 'destask'
       inputTarefa.className = 'col-9 form-control'
       inputTarefa.value = destask
       
       // criar oum input hidden
       let inputId = document.createElement('input')
       inputId.type = 'hidden'
       inputId.name = 'idtask'
       inputId.value = id

       // cria um botao para enviar
       let buttonSend = document.createElement('button')
       buttonSend.type = 'submit'
       buttonSend.className = 'col-3 btn btn-info'
       buttonSend.innerHTML = 'Atualizar'

       // inclui inputTarefa no form
       form.appendChild(inputTarefa)

       //incluir o inputID no form
       form.appendChild(inputId)

       // inclui buttonSend no form
       form.appendChild(buttonSend)

       // seleciona o did da tarefa
       let tarefa = document.getElementById('task-' + id)
       
       // limpa o texto da tarefa para incluir no form
       tarefa.innerHTML = '';

       tarefa.insertBefore(form, tarefa[0])
       
   }


