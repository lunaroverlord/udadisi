import twitter4j.Paging;
import twitter4j.Status;
import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.conf.ConfigurationBuilder;

import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;

/**
 * @author Mateusz
 * 
 *         Creates JSON file with all tweets from specified users, in this case
 *         top tech kenya users.
 */
public class TweetsFromUsers {

	public static final String CONSUMER_KEY = "put here";
	public static final String CONSUMER_SECRET = "put here";
	public static final String ACCESS_TOKEN = "put here";
	public static final String ACCESS_TOKEN_SECRET = "put here";

	public static void main(String[] args) {

		ConfigurationBuilder cb = new ConfigurationBuilder();
		cb.setDebugEnabled(true).setOAuthConsumerKey(CONSUMER_KEY)
				.setOAuthConsumerSecret(CONSUMER_SECRET)
				.setOAuthAccessToken(ACCESS_TOKEN)
				.setOAuthAccessTokenSecret(ACCESS_TOKEN_SECRET);
		TwitterFactory tf = new TwitterFactory(cb.build());
		Twitter twitter = tf.getInstance();

		try {
			List<Status> statuses;
			String user;
			ArrayList<String> users = new ArrayList<String>();
			ArrayList<Integer> tweetNo = new ArrayList<Integer>();
			// all those numbers should be checked after some time, before
			// running, if one want's to get all tweets for those users
			users.add("johnmasiwe");
			tweetNo.add(3350 / 200 + 1); // number of pages of tweets for this
											// user
			users.add("natashawissanji");
			tweetNo.add(1630 / 200 + 1); // number of pages of tweets for this
											// user
			users.add("techytimo");
			tweetNo.add(1600 / 200 + 1); // number of pages of tweets for this
											// user
			users.add("JheneKnights");
			tweetNo.add(440 / 200 + 1); // number of pages of tweets for this
										// user
			users.add("mlabeastafrica");
			tweetNo.add(3650 / 200 + 1); // number of pages of tweets for this
											// user

			ArrayList<Tweet> tweetsAll = new ArrayList<Tweet>();

			for (int i = 0; i < users.size(); i++) {
				for (int j = 1; j < tweetNo.get(i) + 1; j++) {
					user = users.get(i);
					Paging paging = new Paging(j, 200);
					statuses = twitter.getUserTimeline(user, paging);
					for (Status status : statuses) {
						String url = "https://twitter.com/"
								+ status.getUser().getScreenName() + "/status/"
								+ status.getId();
						Tweet tweet = new Tweet(status.getUser()
								.getScreenName(), status.getText(),
								status.getGeoLocation() + "", status.getPlace()
										+ "", status.getCreatedAt().toString(),
								url);
						tweetsAll.add(tweet);
					}
				}
			}
			ObjectMapper mapper = new ObjectMapper();
			TweetList twList = new TweetList(tweetsAll);
			String json = null;
			try {
				json = mapper.writeValueAsString(twList);
			} catch (JsonProcessingException e) {
				e.printStackTrace();
			}
			try {
				FileWriter writer = new FileWriter("tweets_top_users_"
						+ new Date().getTime());
				writer.append(json);
				writer.flush();
				writer.close();
				System.out.println("done");
				System.exit(-1);
			} catch (IOException e) {
				e.printStackTrace();
			}
		} catch (TwitterException te) {
			te.printStackTrace();
			System.out.println("Failed to get timeline: " + te.getMessage());
			System.exit(-1);
		}
	}
}
