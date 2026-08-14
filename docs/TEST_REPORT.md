# Test report

Local acceptance: WordPress 6.6, PHP 8.2, MariaDB 10.11 and WooCommerce 9.7 in Docker.

| Check | Result |
|---|---|
| XLSX → 13 SKU/price seed | passed |
| Real media ZIP extraction | passed: 182 JPG, 9 MP4; SKU folders mapped |
| Media import | passed: all 13 SKU have a real image; 11 use their own named folders and 2 use real archive-level test photos because no named folder exists |
| Homepage / theme response | passed: HTTP 200; hero and real upload URLs present |
| PHP lint | passed for theme/plugin |
| B2B lead REST | passed: HTTP 201, UTM stored |
| Telegram transport | passed: configured local token/recipient sent a test lead without API transport error; token remains only in ignored `.env` |
| Roles | passed: sales/content/warehouse roles created |
| 5,000 fixture | generated and validation run separately before staging import |
| Product page | passed: HTTP 200, real media, price and add-to-cart form rendered |
| Page map | passed: 20 primary storefront and service routes returned HTTP 200 locally |
| Project request | passed: form route rendered and its lead endpoint returned HTTP 201 |
| Decor catalog redesign | passed: `/shop/`, populated decorative-lighting and an empty loft-furniture category returned HTTP 200 with the intended catalog states |

Live payment, Nova Poshta, CRM and Telegram delivery cannot be tested without owner credentials and are deliberately not simulated as successes.
