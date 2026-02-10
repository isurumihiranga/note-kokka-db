# NOTE KOKKA - Complete Setup Guide

## 🎯 What's New in This Version

✅ **Database-Driven Subject Management** - No more manual HTML editing!
✅ **Admin Panel with Full CRUD** - Add, Edit, Delete subjects through UI
✅ **MySQL Database Backend** - Professional data storage
✅ **REST API** - Clean PHP API for data operations
✅ **Production Ready** - Optimized for hosting services

---

## 📋 Prerequisites

Before starting, make sure you have:
- ✅ Web hosting with **PHP 7.4+** and **MySQL 5.7+**
- ✅ cPanel or phpMyAdmin access
- ✅ FTP/SFTP client (FileZilla, WinSCP, etc.)
- ✅ Your hosting login credentials

---

## 🚀 Quick Setup (5 Steps)

### STEP 1: Create Database

1. **Login to cPanel**
2. **Go to MySQL Databases**
3. **Create a new database:**
   - Database name: `note_kokka_db` (or your choice)
4. **Create a database user:**
   - Username: Choose a username
   - Password: Choose a strong password
5. **Add user to database** with ALL PRIVILEGES

💡 **Note down:** Database name, username, and password

---

### STEP 2: Import Database Structure

1. **Go to phpMyAdmin** in cPanel
2. **Select your database** from left sidebar
3. **Click "Import" tab**
4. **Choose file:** Upload `database.sql`
5. **Click "Go"**

✅ You should see: 3 tables created (subjects, analytics, admin_logs)
✅ Sample subjects will be automatically inserted

---

### STEP 3: Configure Database Connection

1. **Open `config.php` in a text editor**
2. **Update these lines:**

```php
define('DB_HOST', 'localhost');              // Usually 'localhost'
define('DB_USER', 'your_db_username');       // From STEP 1
define('DB_PASS', 'your_db_password');       // From STEP 1
define('DB_NAME', 'note_kokka_db');          // From STEP 1
```

3. **Save the file**

---

### STEP 4: Upload Files to Hosting

**Using FTP/SFTP (FileZilla):**

1. **Connect to your hosting**
2. **Navigate to** `public_html` (or your domain folder)
3. **Upload ALL files:**
   ```
   ├── index.html
   ├── styles.css
   ├── logo.jpeg
   ├── config.php
   ├── .htaccess
   └── api/
       └── subjects.php
   ```

4. **Set correct permissions:**
   - Files: 644
   - Folders: 755
   - config.php: 600 (more secure)

---

### STEP 5: Test Your Website

1. **Visit your website:** `https://yourwebsite.com`
2. **Check if subjects load** on Notes page
3. **Test Admin Login:**
   - Click 🔐 icon in header
   - Email: `isurumihi1@gmail.com`
   - Password: `22022imd`
4. **Try adding a new subject** in Admin Panel

✅ **Success!** Your website is now live with database integration!

---

## 🔧 Admin Panel Features

### How to Access
1. Click the 🔐 icon in the header
2. Enter admin credentials
3. Navigate to **Admin Panel** in menu

### What You Can Do

#### ➕ Add Subject
1. Click **"+ Add Subject"**
2. Fill in:
   - Subject Name (e.g., "Physics")
   - Icon Emoji (e.g., "⚡")
   - Google Drive Link
3. Click **"Add Subject"**

#### ✏️ Edit Subject
1. Click **"✏️ Edit"** on any subject
2. Modify the fields
3. Click **"Update Subject"**

#### 🗑️ Delete Subject
1. Click **"🗑️ Delete"** on any subject
2. Confirm deletion
3. Subject will be removed

**All changes are saved to the database automatically!**

---

## 📁 File Structure

```
note-kokka-db/
│
├── index.html              # Main website (React app)
├── styles.css              # All styles
├── logo.jpeg               # Website logo
├── config.php              # Database configuration
├── .htaccess               # Apache configuration
├── database.sql            # Database structure
│
└── api/
    └── subjects.php        # REST API for subjects
```

---

## 🔒 Security Features

✅ **Admin Authentication** - Basic Auth with credentials
✅ **SQL Injection Protection** - Escaped queries
✅ **Config Protection** - .htaccess blocks direct access
✅ **HTTPS Ready** - Uncomment in .htaccess
✅ **Soft Delete** - Subjects marked inactive, not deleted

---

## 🎨 Customization Guide

### Change Admin Credentials

**In `config.php`:**
```php
define('ADMIN_EMAIL', 'your_new_email@example.com');
define('ADMIN_PASSWORD', 'your_new_password');
```

**In `index.html` (line 28-29):**
```javascript
const ADMIN_EMAIL = "your_new_email@example.com";
const ADMIN_PASSWORD = "your_new_password";
```

### Add Google AdSense

**In `index.html`, replace:**
```html
ca-pub-XXXXXXXXXXXXXXXX
```
with your actual AdSense ID

### Update Contact Information

**In `index.html`, find Contact Page section** and update:
- Email address
- Phone number
- Social media links

---

## 🌐 API Documentation

### Get All Subjects
```
GET /api/subjects
Response: { success: true, data: [...] }
```

### Add Subject (Admin Only)
```
POST /api/subjects
Headers: Authorization: Basic base64(email:password)
Body: { name: "...", icon: "...", driveLink: "..." }
```

### Update Subject (Admin Only)
```
PUT /api/subjects
Headers: Authorization: Basic base64(email:password)
Body: { id: 1, name: "...", icon: "...", driveLink: "..." }
```

### Delete Subject (Admin Only)
```
DELETE /api/subjects
Headers: Authorization: Basic base64(email:password)
Body: { id: 1 }
```

---

## 🐛 Troubleshooting

### Problem: Subjects not loading

**Solution:**
1. Check browser console for errors
2. Verify `config.php` has correct database credentials
3. Test database connection in phpMyAdmin
4. Check if `api/subjects.php` is accessible

### Problem: Admin can't login

**Solution:**
1. Verify credentials in both `config.php` and `index.html`
2. Clear browser cache and cookies
3. Check browser console for authentication errors

### Problem: Database connection failed

**Solution:**
1. Verify database exists in phpMyAdmin
2. Check username/password in `config.php`
3. Ensure database user has proper privileges
4. Check if MySQL service is running

### Problem: "500 Internal Server Error"

**Solution:**
1. Check `.htaccess` file exists and is valid
2. Verify PHP version is 7.4+
3. Check file permissions (644 for files, 755 for folders)
4. Enable error reporting temporarily in `config.php`

---

## 📊 Database Schema

### `subjects` Table
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- name (VARCHAR 255)
- icon (VARCHAR 10)
- drive_link (TEXT)
- display_order (INT)
- is_active (TINYINT)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

### `admin_logs` Table
```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- action (VARCHAR 50)
- subject_id (INT)
- details (TEXT)
- created_at (TIMESTAMP)
```

---

## 🔄 Backup Your Data

### Database Backup (Recommended: Weekly)
1. Go to phpMyAdmin
2. Select your database
3. Click "Export"
4. Choose "Quick" export method
5. Download the .sql file

### Full Site Backup (Recommended: Monthly)
1. Download all files via FTP
2. Export database via phpMyAdmin
3. Store both in a safe location

---

## 📈 Future Enhancements

Want to add more features? Here are some ideas:

- 📊 Advanced analytics dashboard
- 👥 Multiple admin users
- 📧 Email notifications for new subjects
- 🔍 Search functionality
- 📱 Progressive Web App (PWA)
- 🎯 Subject categories
- ⭐ User ratings for subjects
- 💬 Comments system

---

## 🆘 Support

Need help? Contact:
- Email: isurumihi1@gmail.com
- Create an issue if you have the project repository

---

## 📝 License

Free to use and modify for your educational platform!

---

## ✅ Launch Checklist

Before going live, ensure:

- [ ] Database created and imported
- [ ] config.php updated with correct credentials
- [ ] All files uploaded to hosting
- [ ] File permissions set correctly
- [ ] Website loads without errors
- [ ] Subjects display on Notes page
- [ ] Admin login works
- [ ] Can add/edit/delete subjects
- [ ] Google Drive links work
- [ ] SSL certificate installed (HTTPS)
- [ ] AdSense code added (if using)
- [ ] Contact information updated
- [ ] Backup created

**Congratulations! Your database-driven website is ready! 🎉**
