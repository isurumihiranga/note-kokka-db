# NOTE කොක්ක - Database Edition

## 🎓 Educational Platform for Sri Lankan Students

**Version:** 2.0 - Database-Driven Edition

---

## 🌟 What's New?

This is a **completely upgraded version** of NOTE කොක්ක with:

✅ **MySQL Database Integration** - No more manual HTML editing!  
✅ **Full Admin Panel** - Add, edit, and delete subjects through a beautiful UI  
✅ **REST API** - Professional PHP backend  
✅ **Easy Hosting** - Deploy to any hosting service (cPanel, Hostinger, Bluehost, etc.)  
✅ **Secure** - Built-in authentication and SQL injection protection  
✅ **Production Ready** - Optimized for performance  

---

## 📦 What's Included?

```
✓ Complete website with React frontend
✓ MySQL database with ready-to-use structure
✓ PHP REST API for data management
✓ Admin panel for non-coders
✓ Responsive design (mobile, tablet, desktop)
✓ Dark/Light theme toggle
✓ Google Drive integration
✓ Analytics dashboard
✓ Google AdSense ready
```

---

## 🚀 Quick Start

### For Hosting (Production)

1. **Create MySQL database** in cPanel
2. **Import** `database.sql` in phpMyAdmin
3. **Configure** `config.php` with your database credentials
4. **Upload files** to your hosting via FTP
5. **Done!** Visit your website

👉 **See [SETUP_GUIDE.md](SETUP_GUIDE.md) for detailed instructions**

### For Local Testing (Optional)

```bash
# Requirements: PHP 7.4+, MySQL 5.7+, Apache/Nginx

# 1. Import database
mysql -u root -p < database.sql

# 2. Update config.php with local credentials

# 3. Start local server
php -S localhost:8000

# 4. Visit http://localhost:8000
```

---

## 🎯 How It Works

### For Admin (You)

1. **Login** with your credentials (click 🔐 icon)
2. **Go to Admin Panel** in the menu
3. **Add subjects** by filling a simple form
4. **Edit or delete** subjects anytime
5. **Changes are instant** - no coding required!

### For Users (Students)

1. Visit website
2. Browse subjects
3. Click to access Google Drive notes
4. Everything updates automatically from database

---

## 🗄️ Database Structure

**3 Tables:**

1. **subjects** - Stores all subject information
2. **admin_logs** - Tracks admin actions (add/edit/delete)
3. **analytics** - (Optional) For future analytics features

**Sample Data Included:**
- Mathematics 📐
- Science 🔬
- Languages 📖
- Technology 💻
- Arts 🎨
- History 🏛️

---

## 🔑 Default Admin Credentials

**Email:** `isurumihi1@gmail.com`  
**Password:** `22022imd`

⚠️ **Important:** Change these in `config.php` and `index.html` before going live!

---

## 📋 System Requirements

### Hosting Requirements

- ✅ PHP 7.4 or higher
- ✅ MySQL 5.7 or higher
- ✅ Apache with mod_rewrite (most hosting has this)
- ✅ At least 50MB storage
- ✅ phpMyAdmin access (for database setup)

### Recommended Hosting Services

- Hostinger (cheap & reliable)
- Bluehost
- SiteGround
- HostGator
- Any cPanel hosting

---

## 🎨 Features

### Frontend
- ⚡ React-based SPA (Single Page Application)
- 🎨 Beautiful dark/light theme
- 📱 Fully responsive design
- ✨ Animated background
- 🎯 Clean, modern UI
- 🌐 Sinhala & English content

### Backend
- 🔒 Secure authentication
- 🛡️ SQL injection protection
- 📊 REST API architecture
- 💾 Efficient database queries
- 📝 Activity logging

### Admin Panel
- 📊 Analytics dashboard
- ➕ Add subjects
- ✏️ Edit subjects
- 🗑️ Delete subjects (soft delete)
- 📈 Visit statistics

---

## 📁 File Structure

```
note-kokka-db/
│
├── 📄 index.html           # Main website (React app)
├── 🎨 styles.css           # All styling
├── 🖼️ logo.jpeg            # Website logo
├── ⚙️ config.php           # Database configuration (IMPORTANT!)
├── 🔧 .htaccess            # Apache configuration
├── 💾 database.sql         # Database structure & sample data
├── 📖 SETUP_GUIDE.md       # Detailed setup instructions
├── 📋 README.md            # This file
│
└── 📁 api/
    └── subjects.php        # REST API endpoint
```

---

## 🔐 Security Features

✅ **Admin Authentication** - Login required for admin actions  
✅ **Password Protection** - Credentials stored in config file  
✅ **SQL Injection Prevention** - All queries properly escaped  
✅ **Direct Access Blocked** - Config file protected via .htaccess  
✅ **Soft Delete** - Subjects deactivated, not deleted  
✅ **HTTPS Ready** - SSL support built-in  

---

## 🛠️ Customization

### Change Admin Credentials

**File: `config.php`**
```php
define('ADMIN_EMAIL', 'your_new_email@example.com');
define('ADMIN_PASSWORD', 'your_new_password');
```

**File: `index.html` (lines 28-29)**
```javascript
const ADMIN_EMAIL = "your_new_email@example.com";
const ADMIN_PASSWORD = "your_new_password";
```

### Add Your AdSense

**File: `index.html`**

Replace all instances of:
```html
ca-pub-XXXXXXXXXXXXXXXX
```

With your actual AdSense publisher ID.

### Update Contact Info

Edit the Contact Page section in `index.html` to add your:
- Email
- Phone
- Social media links

---

## 📊 API Endpoints

### Public Endpoints

```
GET /api/subjects
→ Returns all active subjects
```

### Admin Endpoints (Authentication Required)

```
POST /api/subjects
→ Add new subject

PUT /api/subjects
→ Update existing subject

DELETE /api/subjects
→ Delete subject (soft delete)
```

**Authentication:** Basic Auth (email:password)

---

## 🐛 Common Issues & Solutions

### "Database connection failed"
→ Check credentials in `config.php`  
→ Verify database exists in phpMyAdmin  
→ Ensure user has proper privileges  

### "Subjects not loading"
→ Check browser console for errors  
→ Verify `api/subjects.php` file exists  
→ Test API directly: `yoursite.com/api/subjects`  

### "Admin can't login"
→ Verify credentials match in both files  
→ Clear browser cache  
→ Check sessionStorage is enabled  

### "500 Internal Server Error"
→ Check `.htaccess` file syntax  
→ Verify PHP version (needs 7.4+)  
→ Check file permissions  

---

## 📈 Roadmap

**Planned Features:**
- [ ] Multiple admin users
- [ ] Email notifications
- [ ] Subject categories
- [ ] Search functionality
- [ ] User comments
- [ ] File upload for PDFs
- [ ] Advanced analytics

---

## 🎓 Perfect For

- 📚 Educational platforms
- 🏫 School websites
- 👨‍🏫 Teacher resources
- 📖 Study material collections
- 🎯 Course note repositories
- 🌐 Any content management platform

---

## 💡 Why This Version?

**Before (Version 1.0):**
- ❌ Had to edit HTML code manually
- ❌ Required coding knowledge
- ❌ Risk of breaking website
- ❌ Hard to manage many subjects
- ❌ No data backup

**Now (Version 2.0):**
- ✅ Beautiful admin panel
- ✅ No coding needed
- ✅ Database-backed
- ✅ Easy to manage
- ✅ Professional & scalable

---

## 📞 Support

**Need help?**
- 📧 Email: isurumihi1@gmail.com
- 📖 Read: [SETUP_GUIDE.md](SETUP_GUIDE.md)
- 🐛 Check: Troubleshooting section above

---

## 📝 License

Free to use and modify for educational purposes!

---

## 🎉 Ready to Launch?

Follow the **5-step setup** in [SETUP_GUIDE.md](SETUP_GUIDE.md) and your website will be live in **under 15 minutes**!

**Good luck with your educational platform! 🚀**

---

Made with ❤️ for Sri Lankan students
