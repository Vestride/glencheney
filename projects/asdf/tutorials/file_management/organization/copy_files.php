<h1>Copying Files</h1>
<p>
To copy your files, you use the command <span style="font-family:courier;">
cp [original] [copied]</span>.  
When entered, the command will make a copy of original in your current 
working directory, renamed to copied.
</p>
<div class="shellwindow">
server{username}: ls<br />
Original.txt<br />
server{username}: cp Original.txt Copied.txt<br />
server{username}: ls<br />
Original.txt&nbsp;&nbsp;&nbsp;Copied.txt<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
You can write a file path as part of either one of the 
filename options to get a file from or put it into a 
different directory.  Also, if you are copying the file 
into a different directory and don't want to change the 
name, you can use a dot in place of filename2.  In the 
example below, I take TestFile.txt and copy it into 
the parent directory while keeping the same file name.
</p>
<div class="shellwindow">
server{username}: ls<br />
Original.txt&nbsp;&nbsp;&nbsp;Copied.txt<br />
server{username}: cp Original.txt ../.<br />
server{username}: cd..<br />
server{username}: ls<br />
Example_Dir&nbsp;&nbsp;&nbsp;Original.txt<br />
server{username}: <span style="text-color:white;">|</span>
</div>
&nbsp;<br />

