import twitter4j.*;
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
 *         Creates JSON file with all tweets containing specified key word.
 */
public class SearchTweets {

	public static final int NUMBER_OF_PAGES = 20;
	public static final String QUERRY = "kenya";
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

		ArrayList<Tweet> tweetsAll = new ArrayList<Tweet>();

		try {
			Query query = new Query(QUERRY);
			QueryResult result;
			for (int i = 0; i < NUMBER_OF_PAGES; i++) {
				result = twitter.search(query);
				List<Status> tweets = result.getTweets();
				System.out.println(tweets.size());
				for (Status tweet : tweets) {
					String url = "https://twitter.com/"
							+ tweet.getUser().getScreenName() + "/status/"
							+ tweet.getId();
					tweetsAll.add(new Tweet(tweet.getUser().getScreenName(),
							tweet.getText(), tweet.getGeoLocation() + "", tweet
									.getPlace() + "", tweet.getCreatedAt()
									.toString(), url));
					System.out.println("@" + tweet.getUser().getScreenName()
							+ tweet.getGeoLocation() + " " + tweet.getPlace()
							+ " ");
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
				FileWriter writer = new FileWriter("tweets_key_word_" + QUERRY
						+ "_" + new Date().getTime());
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
			System.out.println("Failed to search tweets: " + te.getMessage());
			System.exit(-1);
		}
	}
}
