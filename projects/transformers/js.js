// JavaScript Document
var path = "http://www.glencheney.com/projects/transformers/"

function changeThat(what)
{
    what.src = path + "/images/" + what.id + "hover.jpg";
}
function revert(what)
{
    what.src = path + "images/" + what.id + ".jpg";
}

var imgArr = [path + 'images/dhover.jpg', path + 'images/beehover.jpg', path + 'images/foxhover.jpg', path + 'images/ophover.jpg', path + 'images/dsmallhover.jpg', path + 'images/beesmallhover.jpg', path + 'images/opsmallhover.jpg', path + 'images/foxsmallhover.jpg'];
//array to hold all of the preloaded images
var imgHolder = new Array();
function init()
{
    for(i=0; i < imgArr.length; i++)
    {
        imgHolder[i] = new Image();
        imgHolder[i].src = imgArr[i];
    }
}

function writeName()
{
    var name = "Glen Cheney";
    var myClass = 409;
    document.getElementById('footer').innerHTML = name + " " + myClass;
}
