package de.effective;

import org.apache.wicket.pageStore.memory.IDataStoreEvictionStrategy;
import org.apache.wicket.pageStore.memory.PageNumberEvictionStrategy;
import org.apache.wicket.protocol.http.WebApplication;
import org.apache.wicket.serialize.ISerializer;

/**
 * Application object for your web application. If you want to run this application without deploying, run the Start class.
 * 
 * @see de.effective.Start#main(String[])
 */
public class EffectiveApplication extends WebApplication
{    	
	/**
	 * @see org.apache.wicket.Application#getHomePage()
	 */
	@Override
	public Class<HomePage> getHomePage()
	{
		return HomePage.class;
	}

	/**
	 * @see org.apache.wicket.Application#init()
	 */
	@Override
	public void init()
	{
		super.init();

        // disable ModificationWatcher
        getResourceSettings().setResourcePollFrequency(null);

        // use plain JDK Object(Input|Output)Stream
        ISerializer serializer = new SimpleJavaSerializer(getApplicationKey());
        getFrameworkSettings().setSerializer(serializer);

        // disable file cleaning because it starts a new thread
        getResourceSettings().setFileCleaner(null);

	}

}
