import java.io.FileOutputStream;
import java.io.IOException;
import java.net.URL;
import java.nio.channels.Channels;
import java.nio.channels.ReadableByteChannel;

/**
 * @author Mateusz
 * 
 *         Program for getting JSONs from Guardian API
 */
public class GuardianApi {

	public static final int NUMBER_OF_PAGES = 13;
	public static final String API_KEY_GUARDIAN = "test";

	public static void main(String[] args) {
		try {
			for (int i = 1; i < NUMBER_OF_PAGES; i++) {

				URL website = new URL(
						"http://content.guardianapis.com/search?q=kenya%20AND%20technology&api-key="
								+ API_KEY_GUARDIAN
								+ "&page-size=100&show-fields=trailText&show-fields=body,thumbnail&order-by=newest&page="
								+ i);
				// "http://content.guardianapis.com/search?q=kenya&api-key=" +
				// API_KEY_GUARDIAN +
				// "&page-size=100&show-fields=trailText&show-fields=body&page="

				ReadableByteChannel rbc = Channels.newChannel(website
						.openStream());
				FileOutputStream fos = new FileOutputStream("guardian" + i);
				fos.getChannel().transferFrom(rbc, 0, Long.MAX_VALUE);
			}
		} catch (IOException e) {
			e.printStackTrace();
		}

	}

}