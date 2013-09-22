<h1>Chmod</h1>
<p>
To set or modify the permissions of a file or directory, 
you need the chmod command. Only the owner of the file 
can modify the permissions. chmod uses the following 
syntax: chmod [options] mode filename.extension. 
mode specifies the new permissions for the file. 
</p>
<p>For example, if everyone had full permissions and you typed "chmod a-x folder1", 
that means execute is cleared for all users.
</p>
<div class="shellwindow">
server{username}: ls -l<br />
drwxrwxrwx &#09; 3 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder1<br />
drwxr-xr-x &#09; 8 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder2<br />
server{username}: chmod a-x folder1<br />
server{username}: ls -l<br />
drw-rw-rw- &#09; 3 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder1<br />
drwxr-xr-x &#09; 8 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder2<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
Permissions start with the letter that 
specifies the people affected.
<object>
<ul>
	<li>u - user (owner)</li>
	<li>g - group that owns the file</li>
	<li>o - other (rest of the world)</li>
	<li>a - all</li>
</ul>
</object>
</p>
<p>
After specifying the users to be affected, 
use the + (set bit) or -(clear bit) to set the 
change instruction for the file. After the + or -, 
specify which abilities you would like to add or remove.
<object>
<ul>
	<li>r - read the file</li>
	<li>w - write the file</li>
	<li>x - execute or run the file as a program</li>
</ul>
</object>
</p>
<p>
If we wanted to give the execute permission back to 
everyone from the last example, it would look like 
this: "chmod a+x folder1"
</p>
<p>
<strong>Caution</strong> giving write (w) permissions to 
other (o), the third triplet, will give everyone in 
the world to access and modify your files!
</p>
&nbsp;<br />
