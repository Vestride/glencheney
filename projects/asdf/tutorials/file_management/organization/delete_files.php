<h1>Deleting Files</h1>
<p>
If you want to remove a file, you simply type <span style="font-family:courier">rm [filename]</span>.
Depending on how your shell is set up, you may be asked to confirm your action. To 
delete, type "yes".
</p>
<div class="shellwindow">
server{username}: ls<br />
Example_Dir&nbsp;&nbsp;&nbsp;Original.txt&nbsp;&nbsp;&nbsp;Copied.txt<br />
server{username}: rm Copied.txt<br />
rm: remove Copied.txt (yes/no)? yes<br />
server{username}: ls<br />
Example_Dir&nbsp;&nbsp;&nbsp;Original.txt<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
If you want to delete a directory, the command changes to <span style="font-family:courier;">rmdir [directory name]</span>. 
</p>
<p>
Just like with cp and mv, you can use file paths to affect 
files not in your current working directory.  This is not recommended, 
however, because UNIX only asks you once, and there is NO WAY TO RECOVER 
DELETED DATA!  Make sure you're deleting the right file 
before saying "yes".
</p>
&nbsp;<br />
