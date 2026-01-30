# nanato_test
WordPress technical exercise – Featured Cases

# Featured Cases – WordPress Technical Exercise

## Overview
This repository contains a simple WordPress implementation to manage and display featured legal cases for a law firm website.

The goal of this exercise is to demonstrate clean WordPress development practices, clear structure, and flexibility in implementation choices.

---

## Approach

The solution was implemented using **native WordPress APIs as the default approach**, with an **optional ACF-based alternative**.

### Default Implementation (Native WordPress)
- Custom Post Type registered using `register_post_type()`
- Custom fields handled via native meta boxes
- No external plugin dependency
- REST API support enabled via `show_in_rest`
- Demonstrates core WordPress knowledge and clean PHP structure

### Optional ACF Implementation
- If Advanced Custom Fields is available, the template automatically supports it
- This reflects a common real-world setup where ACF is preferred by teams
- Only one approach should be used at a time

The template is compatible with both approaches without code duplication.

---

## Features Implemented

- Custom Post Type: **Featured Case**
- Custom Fields:
  - Case Type
  - Settlement Amount
- Page Template to display:
  - At least 3 Featured Case posts
  - Title
  - Case Type
  - Settlement Amount
- REST API ready (CPT exposed for future integrations or headless usage)
- No pagination or filters (as requested)

---

## File Structure
├── README.md
├── featured-cases/
├──── functions.php
├──── page-featured-cases.php
└──── acf-fields.json 

---

## Setup Instructions

1. Copy all files into an active WordPress theme
2. Access the WordPress admin dashboard
3. Create at least 3 "Featured Case" posts
4. Fill in the custom fields (native meta box or ACF)
5. Create a page and assign the **Featured Cases** template
6. View the page on the front end

---

## Notes

- Styling was intentionally omitted to focus on functionality and structure
- The implementation favors clarity and maintainability over complexity
- The code can easily be migrated to a plugin if needed