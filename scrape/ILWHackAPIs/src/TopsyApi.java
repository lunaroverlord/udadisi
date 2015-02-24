import java.io.FileOutputStream;
import java.io.IOException;
import java.net.URL;
import java.nio.channels.Channels;
import java.nio.channels.ReadableByteChannel;

/**
 * @author Mateusz
 * 
 *         Program for getting JSONs from Topsy API (twitter)
 */
public class TopsyApi {

	public static final int NUMBER_OF_PAGES = 13;
	public static final String API_KEY_TOPSY = "put key here";

	public static void main(String[] args) {
		try {
			for (int i = 1; i < NUMBER_OF_PAGES; i++) {

				URL website = new URL(
						"http://otter.topsy.com/search.js?perpage=100&window=a&q=from%3Ajohnmasiwe&apikey="
								+ API_KEY_TOPSY
								+ "&type=tweet&sort_method=date&page=" + i);
				// "http://otter.topsy.com/search.js?perpage=1000&mintime=1298988054&q=kenya&apikey="+API_KEY_TOPSY+"&maxtime=1424268031&type=tweet&sort_method=date&page="
				// "http://otter.topsy.com/search.js?perpage=100&window=a&q=from%3Ajohnmasiwe&apikey="+API_KEY_TOPSY+"&type=tweet&sort_method=date&page="

				ReadableByteChannel rbc = Channels.newChannel(website
						.openStream());
				FileOutputStream fos = new FileOutputStream("tweets" + i);
				fos.getChannel().transferFrom(rbc, 0, Long.MAX_VALUE);
			}
		} catch (IOException e) {
			e.printStackTrace();
		}

	}

}
