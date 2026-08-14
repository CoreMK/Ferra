# Decisions
Core: WordPress + WooCommerce + custom Gutenberg-compatible theme; no page builder, VPS, React or paid plugin. Free alternatives: WooCommerce importer/analytics, Rank Math Free, WP 2FA, Limit Login Attempts Reloaded, UpdraftPlus Free. Official payment and Nova Poshta connectors are installed only after provider selection. Cloudflare Free is sufficient at launch.

## Languages

The storefront is bilingual: Ukrainian is the default and English is available by the UA/EN switcher. English URLs use `?lang=en`, so WooCommerce products, stock, prices, cart and checkout stay shared rather than creating duplicate SKUs. The custom theme translates its public interface and preserves the selected language through internal storefront links. Product names, SKU and manufacturer-confirmed facts remain unchanged unless an approved English product translation is provided. This avoids Polylang's paid WooCommerce bridge and keeps the shared-hosting install lean.
