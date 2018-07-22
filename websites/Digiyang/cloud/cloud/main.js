var sendgrid = require("sendgrid");
sendgrid.initialize("kr.prastut", "Shivam12345");

// Use Parse.Cloud.define to define as many cloud functions as you want.
// For example:
Parse.Cloud.define("hello", function(request, response)
{
    response.success("Hello world!");
});


Parse.Cloud.afterSave("proposal", function(request)
{	


	var name = request.object.get("name");
	var college = request.object.get("college");
	var society = request.object.get("society");
	var number = request.object.get("phone");
	var email = request.object.get("email");
	var file = request.object.get("proposal");
    console.log("Working");

    sendgrid.sendEmail(
    {
        to: ["kr.prastut@gmail.com" ,"prastut.kumar2014@vit.ac.in"],
        from: "kr.prastut@gmail.com",
        subject: "New Proposal from : " + name,
        text: "Name :" + name + ", College :" + college + ", Society: " + society + ", number: " + number + ", Email: " + email + ", \n Proposal:" + file.url(),
        files: [{filename: 'Report.pdf', content: file}]
    },
    {
        success: function(response)
        {
            response.success("Email sent!");
        },
        error: function(response)
        {
            response.error("Uh oh, something went wrong");
        }
    });
});
