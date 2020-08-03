//Script
$(document).ready(function() {
 
    /**
     * Admin/Perfil
     */
    formDesname = document.getElementById("formDesname");
    formDeslastname = document.getElementById("formDeslastname");
    formUsphone = document.getElementById("formUsphone");
    formUsaddress = document.getElementById("formUsaddress");
    formUsemail = document.getElementById("formUsemail");

    $("#perfilDesname").click(function()
    {
        itemDisplay(formDesname)
        this.style.display = "none"
    });

    $("#perfilDeslastname").click(function()
    {
        itemDisplay(formDeslastname)
        this.style.display = "none"
    });
    
    $("#perfilUsphone").click(function()
    {
        itemDisplay(formUsphone)
        this.style.display = "none"
    });

    $("#perfilUsaddress").click(function()
    {
        itemDisplay(formUsaddress)
        this.style.display = "none"
    });

    $("#perfilUsemail").click(function(e)
    {
        itemDisplay(formUsemail)
        this.style.display = "none"
    });

    function itemDisplay(document) 
    {
        if (document.style.display === "none") 
        {
            document.style.display = "block";
        } 
        else 
        {
            document.style.display = "none";
        }
    }
});
    
    