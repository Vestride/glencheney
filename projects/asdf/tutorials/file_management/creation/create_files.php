<h1>Creating Files</h1>
<p>
Finally, we're going to learn how to create a file.  
This is very very simple file creation, we'll learn how to 
do more with files in the "Editing Files" section.
</p>
<p>
For now, we're going to use the command "cat", which is 
your all-purpose command to making and read text files.  
Enter "cat > (file name).txt" into the command line, 
then type a short message, and finish by moving to a 
new line and pressing "ctrl + D".  When you're done, 
you can view your file by entering "cat (file name)".  
Note that the file name must also be one word.
</p>
<div class="shellwindow">
server{username}: cat > TestFile.txt<br />
This is a test.<br />
We are writing in a text file.<br />
Yay!<br />
server{username}: cat TestFile.txt<br />
This is a test.<br />
We are writing in a text file.<br />
Yay!<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
If you want to add on to an existing text file, 
you can enter "cat >> (file name).txt".  Anything 
you type will be added to the end of the selected text file.
</p>
<div class="shellwindow">
server{username}: cat >> TestFile.txt<br />
This is my addition.<br />
It will go at the end of the file<br />
server{username}: cat TestFile.txt<br />
This is a test.<br />
We are writing in a text file.<br />
Yay!<br />
This is my addition.<br />
It will go at the end of the file<br />
server{username}: <span style="text-color:white;">|</span>
</div>
&nbsp;<br />

