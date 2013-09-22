<h1>Numeric Permissions</h1>
<p>
More commonly used are the numeric permissions. 
The mode number is a three digit number, like 755. 
Each digit corresponds to one of the three permission 
triplets (user, group, and owner). Every permission 
bit in a triplet corresponds to a value.
</p>
<p>
Read (r) is 4, write (w) is 2, and execute (x) is 1.
</p>
<p>For a file with rwxr-xr-x permissions, we would add the triplet for the 
owner (rwx) 4+2+1 = 7. We would then add x-r for group (4+0+1=5) and 
the same for other. Therefore, the numeric 
permissions for rwxr-xr-x are 755. 777 is full read 
write execute permissions for everyone, meaning everyone has 
the ability to read, modify, and execute your files!
</p>
<p>
Some commonly used permissions are
<object>
<dl>
	<dt>chmod 755 TestFile.txt</dt>
		<dd>Read, write, and execute for the owner</dd>
		<dd>Read and execute for everyone else</dd>
	<dt>chmod 644 TestFile.txt</dt>
		<dd>Read and write for the owner</dd>
		<dd>Read only for everyone else</dd>
	<dt>chmod 666 TestFile.txt</dt>
		<dd>Read and write for everyone</dd>
</dl>
</object>
</p>
	
&nbsp;<br />

