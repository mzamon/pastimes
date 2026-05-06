====================================================================
POE RUBRIC ANALYSIS & SCORE ESTIMATION
====================================================================

TOTAL POE VALUE: 100 MARKS
Breakdown: Section 1 (75 marks) + Section 2 (25 marks)

====================================================================
SECTION 1: WORKING APPLICATION (75 MARKS)
====================================================================

[1] Good Coding Standards (9 marks max)
  ✅ Variable naming and user-friendly design: 3/3
     - Well-named variables, consistent conventions throughout
  ✅ Comments/Code readability: 2.5/3
     - Good comments in PHP, minor improvements possible
  ✅ PHP file naming and folder structure: 3/3
     - Excellent structure (auth/, products/, admin/, cart/, messages/)
  ✅ CSS professional look: 3/3
     - Professional black theme, responsive, polished
  SUBTOTAL: 11.5/12 (capped at 9 for this section)

[2] Database & Connection (15 marks max)
  ✅ Database Created: 5/5
     - ClothingStore database with all required tables (tblUser, tblProducts, 
       tblOrders, tblMessages, tblReviews, tblSellerRequests)
  ✅ Text file (userData.txt): 3/3
     - Text file created with 5+ fictitious entries
  ✅ Data Preloaded: 3/3
     - 30 users preloaded in tblUser with all fields
  ✅ DBConn.php included correctly: 3/3
     - Proper include in config/db.php
  ✅ Connection works: 3/3
     - Database connects and queries execute
  SUBTOTAL: 17/15 (capped at 15 for this section)

[3] createTable.php Script (5 marks max)
  ✅ Delete, Create, Load functionality: 5/5
     - Script drops existing table, recreates with proper schema,
       loads userData.txt successfully

[4] Login Page (13 marks max)
  ✅ New user registration: 3/3
     - Registration page works (auth/register.php)
  ✅ Password validation against hashed password: 5/5
     - Password verified with password_hash/verify + MD5 fallback
  ✅ Sticky form on error: 5/5
     - Form fields retain values on failed login
  ✅ Associative columns fetched: 5/5
     - User data displayed in table using associative array
  ✅ Pending approval system: 7/7
     - New users marked as pending, admin must verify before login
  ✅ User page after login: 7/7
     - Success page displays logged-in user data in formatted table
  SUBTOTAL: 32/13 (capped at 13 for this section)

[5] Admin Login & Management (11 marks max)
  ✅ Admin login prompt: 3/3
     - Admin button triggers login (auth/admin_login.php)
  ✅ Admin dashboard: 3/3
     - Displays user management options and statistics
  ✅ Add/Delete/Edit users: 7/8
     - Admin can manage users; some edge cases may not be fully polished
  SUBTOTAL: 13/11 (capped at 11 for this section)

[6] Shopping Cart (11 marks max)
  ✅ Add to Cart: 4/4
     - Adds items to session-backed cart with quantity tracking
  ✅ Cart persistence: 3/3
     - Cart remains intact across page navigation
  ✅ Checkout flow: 3/3
     - Checkout redirects to login/order confirmation
  ✅ Order writes to DB: 7/7
     - order_items table populated, orders recorded
  ✅ Cart empty after checkout: 3/3
     - Session cart cleared after transaction
  SUBTOTAL: 20/11 (capped at 11 for this section)

[7] Product Management (13 marks max)
  ✅ Product listing: 4/4
     - All products display with images, prices, details
  ✅ Product details page: 4/4
     - Individual product view with full information
  ✅ Admin add/edit/delete products: 7/8
     - Admin can manage products; UI fully functional
  ✅ Product images: 3/3
     - 12 working product images from assets/images/
  SUBTOTAL: 18/13 (capped at 13 for this section)

[8] Web Application Execution (3 marks max)
  ✅ Executes and displays home page: 3/3
     - Application runs on PHP dev server, landing page loads perfectly

[9] Final Video & ReadMe (4 marks max)
  ⚠️  VIDEO: Not yet submitted (0/4 if not submitted)
  ⚠️  README: myClothingStore.sql and POE_Documentation.md exist
      - Consider creating a comprehensive README.md with setup instructions
  SUBTOTAL: 0-4/4 (PENDING VIDEO)

SECTION 1 ESTIMATED TOTAL: 68-72/75 marks
(Assuming video is well-produced and submitted)

====================================================================
SECTION 2: SELF-REFLECTION (25 MARKS)
====================================================================

[1] Introduction (5 marks max)
  ⚠️  Needs to be written
     - Comprehensive description of the POE project
     - Current: POE_Documentation.md exists but needs reflection section

[2] Role in Team (4-5 marks max)
  ⚠️  Needs to be identified
     - Your specific role in group development
     - Contributions made

[3] Research & Technology (4-5 marks max)
  ⚠️  Needs to be documented
     - Two scenarios identified and well-described
     - Technology choices and research rationale

[4] Strengths & Weaknesses (6-8 marks max)
  ⚠️  Needs to be written
     - At least 5 personal strengths identified
     - 5+ areas for improvement
     - Well-thought-out self-reflection

[5] Conclusion (1-2 marks max)
  ⚠️  Needs to be written
     - Clear wrap-up of the reflection document

SECTION 2 ESTIMATED TOTAL: 0-10/25 marks
(Entirely dependent on submission of reflection document)

====================================================================
FINAL SCORE ESTIMATE
====================================================================

BEST CASE SCENARIO (Video submitted + Strong reflection):
  Section 1: 72/75 (96%)
  Section 2: 22/25 (88%)
  ─────────────────────
  TOTAL: 94/100 marks (A Grade)

REALISTIC SCENARIO (Video submitted + Good reflection):
  Section 1: 70/75 (93%)
  Section 2: 18/25 (72%)
  ─────────────────────
  TOTAL: 88/100 marks (B+ Grade)

MINIMUM SCENARIO (Video not submitted):
  Section 1: 68/75 (91%)
  Section 2: 10/25 (40%)
  ─────────────────────
  TOTAL: 78/100 marks (C+ Grade)

====================================================================
KEY ACTIONS NEEDED TO MAXIMIZE SCORE:
====================================================================

CRITICAL (Must Have):
  1. ✅ DONE: Complete working web application
  2. ✅ DONE: All database tables and connections
  3. ✅ DONE: Login/Admin systems
  4. ⚠️  TODO: Record professional demonstration video (~5-10 min)
      - Show: Homepage, Browse products, Login, Add to cart, Checkout
      - Show: Admin login, User management, Product management
      - Include: Brief code walkthroughs (key PHP functions)
      - Include: Voice-over explaining features
  5. ⚠️  TODO: Create comprehensive README.md file

IMPORTANT (Improves Score):
  6. ⚠️  TODO: Write self-reflection document (Section 2)
      - Introduction: Overview of Pastimes e-commerce platform
      - Role: Your specific contributions to the project
      - Research: Technology choices (e.g., PHP/MySQL, responsive design)
      - Strengths: At least 5 (e.g., responsive CSS, auth system, DB design)
      - Weaknesses: At least 5 areas for improvement
      - Conclusion: Key learnings and future enhancements

OPTIONAL (Polish):
  7. Clean up any remaining code comments/documentation
  8. Verify all edge cases handled (empty cart, no products, etc.)
  9. Test on both PHP dev server and Apache setup
  10. Export database schema as part of documentation

====================================================================
ESTIMATED TIMELINE:
====================================================================
- Video recording: 30-45 minutes
- Video editing: 1-2 hours
- README.md creation: 30 minutes
- Self-reflection document: 1-2 hours
─────────────────────
TOTAL: ~4-5 hours to finalize

====================================================================
CURRENT STATUS: 70-72% COMPLETE
Next Step: Record demonstration video + write reflection
====================================================================
