Parse.initialize("n0vsd3NHcndMrbhk9oU3AISWfp8C6VBbj6rj5Y1Q", "lHHyVP8lnD1mdQhutzDvsdIgO0ZWB5Jxa0IjNnT6");

var file;

$("#upload-proposal").submit(function(e)
{
    e.preventDefault();
    proposalSave();
});


$('#proposal').bind("change", function(e)
{
    var files = e.target.files || e.dataTransfer.files;
    file = files[0];

});


function proposalSave()
{
    console.log(file);

    var proposalObj = Parse.Object.extend("proposal");
    var pObj = new proposalObj();

    var filename = file.name.split(".")[0];
    var filextension = file.name.split(".").pop();

    var parsefile = new Parse.File(filename + "." + filextension, file);


    parsefile.save().then(function()
    {

        pObj.set("name", $("#name").val());
        pObj.set("college", $("#college").val());
        pObj.set("society", $("#society").val());
        pObj.set("phone", parseInt($("#phone").val()));
        pObj.set("email", $("#email").val());
        pObj.set("proposal", parsefile);


        pObj.save(null,
        {
            success: function(result)
            {
                console.log("Yikes");
            },
            error: function(comment, error)
            {
                notify(error.message, "error", 3);
            }
        });

    });
}
