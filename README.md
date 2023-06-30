# aptLearn Basic SEO WordPress Plugin

The aptLearn Basic SEO plugin is a powerful tool designed to enhance the search engine optimization (SEO) capabilities of your aptLearn.io website. It offers a range of features and functionalities to optimize your website's visibility, improve search rankings, and drive organic traffic.

## Features

1. **Meta Tags Optimization**: The plugin allows you to easily add meta tags to your website's head section. You can customize the meta title and description based on your requirements. The plugin automatically generates default values but also provides the flexibility to override them for individual posts and pages.

   - Function: `aptlearn_basic_seo_add_meta_tags()`
   - Description: This function adds meta tags, including the title and description, to the head section of the website. It generates default values but allows customization for individual posts and pages.

2. **Schema Markup**: aptLearn Basic SEO includes schema.org JSON-LD markup, which helps search engines understand the content and structure of your website. It generates structured data for articles, courses, lessons, and topics, improving your website's visibility in search results and enabling rich snippets.

   - Function: `aptlearn_basic_seo_add_meta_tags()`
   - Description: This function generates schema.org JSON-LD markup for articles, courses, lessons, and topics, enhancing the visibility of your website in search results.

3. **Canonical URLs**: The plugin automatically adds canonical URLs to prevent duplicate content issues. Canonical URLs indicate the preferred version of a web page, improving search engine indexing and ranking.

   - Function: `aptlearn_basic_seo_add_canonical_url()`
   - Description: This function adds the canonical URL to the head section of the website. It helps search engines identify the preferred version of a web page and avoid duplicate content indexing.

4. **Robots Meta Tag**: You can easily customize the robots meta tag using the plugin. The meta tag allows you to control search engine crawling and indexing behavior. Set the desired values such as "index, follow" or "noindex, nofollow" to influence how search engines interact with your website.

   - Function: `aptlearn_basic_seo_add_robots_meta_tag()`
   - Description: This function adds the robots meta tag to the head section of the website. It allows customization of search engine crawling and indexing behavior.

5. **Link Management**: The plugin provides an advanced link management feature. It automatically adds a "nofollow" attribute to external links, helping to preserve link juice and reduce the risk of spam. You can also exclude specific domains from this behavior.

   - Function: `aptlearn_basic_seo_manage_links()`
   - Description: This function manages links in the content and adds the "nofollow" attribute to external links. It helps preserve link juice and prevents spam. You can exclude specific domains from this behavior.

6. **Redirect Old URLs**: aptLearn Basic SEO enables you to set up redirects for outdated URLs. It automatically redirects visitors from old URLs to their corresponding new URLs, ensuring a seamless user experience and maintaining search engine rankings.

   - Function: `aptlearn_basic_seo_redirect_old_urls()`
   - Description: This function redirects old URLs to new URLs. It ensures a seamless user experience and maintains search engine rankings.

7. **AdSense Auto Ads**: The plugin simplifies the process of inserting Google AdSense auto ads. By adding a single line of code, you can effortlessly monetize your website and maximize revenue potential.

   - Function: `aptlearn_basic_seo_insert_adsense_auto_ads()`
   - Description: This function inserts the required JavaScript code for Google AdSense auto ads. It allows you to monetize your website with minimal effort.

8. **Meta Descriptions and Targeted Keywords**: You can define custom

 meta descriptions and targeted keywords for posts, courses, lessons, and topics, improving SEO and enhancing click-through rates.

   - Functions: `aptlearn_basic_seo_add_meta_description_box()`, `aptlearn_basic_seo_save_meta_description_box_data()`, `aptlearn_basic_seo_add_keywords_box()`, `aptlearn_basic_seo_save_keywords_box_data()`
   - Description: These functions enable you to add and save custom meta descriptions and targeted keywords for posts, courses, lessons, and topics, enhancing SEO and click-through rates.

9. **Category Base Removal**: aptLearn Basic SEO provides an option to remove the category base from your website's URLs. It eliminates the "/category/" prefix, creating cleaner and more user-friendly URLs.

   - Function: `aptlearn_basic_seo_remove_category_base()`
   - Description: This function removes the category base from your website's URLs, creating cleaner and more user-friendly URLs.

10. **Sitemap Generation**: The plugin generates XML sitemaps for your website, including general content, courses, course categories, and post categories. Sitemaps improve search engine crawling and indexing, leading to better visibility in search results.

    - Functions: `aptlearn_basic_seo_generate_sitemap()`, `aptlearn_basic_seo_add_sitemap_rewrite_rules()`
    - Description: These functions generate XML sitemaps for general content, courses, course categories, and post categories. Sitemaps improve search engine crawling and indexing.


## Installation

To install the aptLearn Basic SEO plugin, follow these steps:

1. Download the plugin zip file from the [aptLearn Basic SEO GitHub repository](https://github.com/aptlearnIO/aptLearn-Seo-Plugin).

2. Login to your WordPress admin dashboard.

3. Navigate to **Plugins > Add New**.

4. Click on the **Upload Plugin** button.

5. Choose the plugin zip file you downloaded in step 1 and click **Install Now**.

6. After installation, click **Activate** to activate the aptLearn Basic SEO plugin.

## Usage

Once the aptLearn Basic SEO plugin is activated, you can start leveraging its powerful SEO features to optimize your aptLearn.io website. Here's how you can use the plugin:

1. **Meta Tags Optimization**: Customize the meta title and description for your posts and pages to improve their visibility in search results.

2. **Schema Markup**: Enhance the visibility of your articles, courses, lessons, and topics in search results by leveraging the schema.org JSON-LD markup generated by the plugin.

3. **Canonical URLs**: Add canonical URLs to prevent duplicate content issues and improve search engine indexing.

4. **Robots Meta Tag**: Customize the robots meta tag to control search engine crawling and indexing behavior.

5. **Link Management**: The plugin automatically adds the "nofollow" attribute to external links, helping to preserve link juice and reduce spam. Exclude specific domains from this behavior if needed.

6. **Redirect Old URLs**: Set up redirects for outdated URLs to maintain search engine rankings and provide a seamless user experience.

7. **AdSense Auto Ads**: Monetize your website by easily inserting Google AdSense auto ads with a single line of code.

8. **Meta Descriptions and Targeted Keywords**: Define custom meta descriptions and targeted keywords for posts, courses, lessons, and topics to enhance SEO and click-through rates.

9. **Category Base Removal**: Remove the category base from your website's URLs to create cleaner and more user-friendly URLs.

10. **Sitemap Generation**: Generate XML sitemaps for general content, courses, course categories, and post categories to improve search engine crawling and indexing.

For detailed information on each feature, including function descriptions, please refer to the [Function Descriptions](https://github.com/aptlearnIO/aptLearn-Seo-Plugin#function-descriptions) section in the repository.

## Compatibility

The aptLearn Basic SEO plugin is compatible with the latest version of WordPress and is actively maintained and updated. It seamlessly integrates with aptLearn.io websites, providing a range of SEO features specifically tailored for aptLearn users.

## License

This plugin is released under the GNU General Public License v2 or later. You are free to modify and customize the plugin according to your needs. For more details, please visit the [GNU GPL website](https://www.gnu.org/licenses/gpl-2.0.html).

## Support and Contribution

If you encounter any issues or have suggestions for improvements, please open an issue on the [aptLearn Basic SEO GitHub repository](https://github.com/aptlearnIO/aptLearn-Seo-Plugin). Contributions are welcome and greatly appreciated. Together, let's make aptLearn Basic SEO even better!

## About aptLearn

aptLearn is a leading online learning platform that offers comprehensive and practical courses in various disciplines, including Engineering, Product, Design, Data Science, Business, and more. Visit [aptLearn.io](https://aptlearn.io) to explore our courses and unlock your potential in the digital world.

## Repository

For the latest updates and contributions, please visit the [aptLearn Basic SEO GitHub repository](https://github.com/aptlearnIO/aptLearn-Seo-Plugin).
