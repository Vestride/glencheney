<h1>Creating Directories</h1>
<p>
To start off, you will need to make a directory.  The command for 
this is "mkdir (folder name)". The folder name has to be a single 
word.  Make a folder using the command.
</p>
<p>
It would be nice to see what you have created.  Type in "ls" and 
press Enter.  It will show you a list of folders and files in your 
current directory. 
</p>
<div class="shellwindow">
server{username}: mkdir Example_Dir<br />
server{username}: ls<br />
Example_Dir<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
Many UNIX commands have extra options you can add to get different 
effects out of them.  The two most important are "ls -l" and "ls -a".  
"ls -l" shows you all of the contents as a list and displays a lot 
of additional information.  The most important of which is the 
permissions, which you'll learn about in the "Internet Concerns" Tutorial.  
"ls -a" shows you hidden files, whose name will begin with a dot.  
These are usually system files, and you shouldn't mess with them 
unless you really know what you're doing.  It will also show a 
single dot and a pair of dots.  We'll cover these next.
</p>
<p>
Also note that options can be combined, written as "ls -al" or 
"ls -la" - the order of the two does not matter.
<object>
<div class="shellwindow">
server{username}: ls<br />
Example_Dir<br />
server{username}: ls -l<br />
total 0<br />
drwx------ &#09; 2 &#09; username &#09; student &#09;&nbsp; 96 Jan 01 00:00 Example_Dir<br />
server{username}: ls -a<br />
. &#09;&#09; .. &#09;&#09; Example_Dir<br />
server{username}: ls -al<br />
total 2<br />
drwx------ &#09; 3 &#09; username &#09; student &#09;&nbsp;   96 Jan 01 00:00 .<br />
drwxr-xr-x &#09; 8 &#09; username &#09; student &#09; 1024 Jan 01 00:00 ..<br />
drwx------ &#09; 2 &#09; username &#09; student &#09;&nbsp;   96 Jan 01 00:00 Example_Dir<br />
server{username}: <span style="text-color:white;">|</span>
</div>
</object>
</p>
&nbsp;<br />

