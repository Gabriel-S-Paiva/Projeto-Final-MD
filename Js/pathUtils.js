// Path resolution utility for all JavaScript files
// This function ensures images and assets load correctly regardless of page location

/**
 * Resolves asset paths based on current page location
 * @param {string} assetPath - The original asset path from database (e.g., "Assets/Imgs/planer.png")
 * @returns {string} - The correctly resolved path for current location
 */
function resolveAssetPath(assetPath) {
  // If we're in a page (URL contains /pages/), prepend ../
  if (window.location.pathname.includes('/pages/')) {
    return assetPath.startsWith('../') ? assetPath : '../' + assetPath;
  }
  // If we're in root, use path as is
  return assetPath;
}

/**
 * Resolves API paths based on current page location
 * @param {string} apiPath - The API endpoint path (e.g., "api/modules.php")
 * @returns {string} - The correctly resolved API path for current location
 */
function resolveApiPath(apiPath) {
  // If we're in a page (URL contains /pages/), prepend ../
  if (window.location.pathname.includes('/pages/')) {
    return apiPath.startsWith('../') ? apiPath : '../' + apiPath;
  }
  // If we're in root, use path as is
  return apiPath;
}

/**
 * Resolves page navigation paths
 * @param {string} pagePath - The page path (e.g., "login.php" or "index.php")
 * @returns {string} - The correctly resolved page path for current location
 */
function resolvePagePath(pagePath) {
  // If trying to go to index.php from a page
  if (pagePath === 'index.php' && window.location.pathname.includes('/pages/')) {
    return '../index.php';
  }
  
  // If trying to go to a page from root
  if (pagePath !== 'index.php' && !window.location.pathname.includes('/pages/')) {
    return `pages/${pagePath}`;
  }
  
  // If already in pages folder, just use the filename
  return pagePath;
}

// Export for backwards compatibility (keep existing function name)
const resolveImagePath = resolveAssetPath;
