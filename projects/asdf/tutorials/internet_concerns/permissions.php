<h1>Permissions</h1>
<p>
Every file and directory on the UNIX system has permissions 
associated with it. Permissions allow UNIX to decide who 
does what with the files. There are three things you can, 
or cannot, do with a file.
<object>
<ul>
	<li>Read it</li>
	<li>Write (modify) it</li>
	<li>Execute it (allows for the use of scripts and other executable programs)</li>
</ul>
</object>
</p>
<p>
Directories are a little different than  files.
<object>
<ul>
	<li>Read on a directory determines if a user can view the directory's contents</li>
    <li>Write access on a directory means you can add or delete files</li>
    <li>Execute permission on a directory means you can list the files in that directory</li>
</ul>
</object>
</p>
<p>
Unix permissions specify what the owner can do, what the 
owner group can do, and what everybody else can do with 
the file. In the command prompt, type "ls -l" like we did back 
in the "File Creation" Tutorial to display the files and information
</p>
<div class="shellwindow">
server{username}: ls<br />
Example_Dir<br />
server{username}: ls -l<br />
drwxr-xr-x &#09; 3 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder1<br />
drwxr-xr-x &#09; 8 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder2<br />
-rwxr-xr-x &#09; 2 &#09; username &#09; student &#09; 2023 Jan 01 00:00 folder3<br />
drwxr-xr-x &#09; 2 &#09; username &#09; student &#09; 1024 Jan 01 00:00 folder4<br />
server{username}: <span style="text-color:white;">|</span>
</div>
<p>
The first column are the permissions. The 'd' at the beginning of 
the first, second, and fourth entries represents a directory. 
The dash instead of a 'd' in the third entry indicates that 
it is file.
</p>
<p>Now let's look at the third entry -rwxr-xr-x. 
The first three letters (rwx) represent the permissions for 
the owner. The owner can read (r), write (w), and execute (x) 
this file.
</p>
<p>The next three letters (r-x) represent what the 
group can do. In this case, the group can read (r) and execute 
(x), but it cannot modify the file (write (w)). As you can see, 
there is a dash where the (w) would go.</p>
<p>
The permissions for other (the rest of the world) are the 
last three letters (r-x), and they are the exact same as 
the group's permissions in this case; they can read and 
execute, but not write.
</p>
<div style="text-align:center;"><img src="permissions.gif" alt="user, group, world" /></div>
&nbsp;<br />

