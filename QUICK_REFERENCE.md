# 📋 QUICK REFERENCE - NOTE KOKKA

## 🚀 5-Minute Setup

```bash
1. Create MySQL database in cPanel
2. Import database.sql in phpMyAdmin
3. Edit config.php with database credentials
4. Upload all files via FTP to public_html/
5. Visit: yourwebsite.com
```

---

## 🔑 Default Credentials

**Admin Login:**
- Email: `isurumihi1@gmail.com`
- Password: `22022imd`

⚠️ **Change in:** `config.php` + `index.html` (line 28-29)

---

## 📁 File Structure

```
public_html/
├── index.html          ← Main website
├── styles.css          ← Styles
├── logo.jpeg           ← Logo
├── config.php          ← Database config (IMPORTANT!)
├── .htaccess           ← Apache rules
└── api/
    └── subjects.php    ← API endpoint
```

---

## ⚙️ config.php Template

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username_here');
define('DB_PASS', 'your_password_here');
define('DB_NAME', 'your_database_here');
```

---

## 🎯 Admin Panel Access

1. Click 🔐 icon in header
2. Enter credentials
3. Click "Admin Panel" in menu
4. Add/Edit/Delete subjects

---

## 🗄️ Database Tables

- `subjects` - All subject data
- `admin_logs` - Admin actions
- `analytics` - Visit tracking

---

## 🔗 Important URLs

```
Website: https://yourwebsite.com
Admin: Click 🔐 icon
API: https://yourwebsite.com/api/subjects
Check Install: https://yourwebsite.com/check_install.php
```

---

## ✅ After Upload Checklist

- [ ] Database created & imported
- [ ] config.php updated
- [ ] All files uploaded
- [ ] Permissions set (644/755)
- [ ] Website loads
- [ ] Subjects display
- [ ] Admin login works
- [ ] Can add subjects
- [ ] SSL enabled
- [ ] Delete check_install.php

---

## 🐛 Common Fixes

**Subjects not loading?**
→ Check config.php credentials
→ Import database.sql
→ Verify api/subjects.php exists

**Admin can't login?**
→ Check credentials in both files
→ Clear browser cache

**500 Error?**
→ Check .htaccess
→ Verify PHP 7.4+
→ Set permissions: 644/755

**Database connection failed?**
→ Verify DB credentials
→ Check DB exists
→ Test in phpMyAdmin

---

## 📱 Support Files

- `README.md` - Overview
- `SETUP_GUIDE.md` - Detailed setup
- `HOSTING_GUIDE.md` - Hosting-specific
- `database.sql` - Database structure

---

## 🔒 Security Checklist

- [ ] Changed admin credentials
- [ ] Deleted check_install.php
- [ ] SSL/HTTPS enabled
- [ ] config.php protected by .htaccess
- [ ] Regular backups scheduled

---

## 💡 Quick Tips

**To add subject:**
Admin Panel → + Add Subject → Fill form → Save

**To backup:**
phpMyAdmin → Export → Download .sql

**To update drive link:**
Admin Panel → Edit subject → Change link → Update

**To hide subject:**
Admin Panel → Delete (soft delete - can restore)

---

## 📞 Get Help

1. Check browser console (F12)
2. Read SETUP_GUIDE.md
3. Test with check_install.php
4. Email: isurumihi1@gmail.com

---

**Good luck! 🚀**
