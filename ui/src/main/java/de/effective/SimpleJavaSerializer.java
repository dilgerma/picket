package de.effective;

import org.apache.wicket.serialize.java.JavaSerializer;

import java.io.*;

public class SimpleJavaSerializer extends JavaSerializer
{
	public SimpleJavaSerializer(String applicationKey)
	{
		super(applicationKey);
	}

	@Override
	protected ObjectInputStream newObjectInputStream(InputStream in) throws IOException
	{
		return new ObjectInputStream(in);
	}

	@Override
	protected ObjectOutputStream newObjectOutputStream(OutputStream out) throws IOException
	{
		return new ObjectOutputStream(out);
	}
}