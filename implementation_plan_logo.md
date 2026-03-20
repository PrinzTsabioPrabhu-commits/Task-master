# Navigation & Logo Minimalism Refinement

The goal is to make the navigation panel and logo feel more minimalist and "premium slim" across the whole app, addressing the user's feedback that the logo is too large.

## Proposed Changes

### [layouts/navigation.blade.php](file:///c:/Users/Prinz%20Tsabio/Herd/e-library2/task-app/resources/views/layouts/navigation.blade.php)
- Shrink logo icon from `w-11 h-11` to `w-9 h-9`.
- Shrink logo text from `text-2xl` to `text-xl`.
- Reduce horizontal/vertical padding for a more compact "pill" feel.
- Add `sticky top-6` to the nav container so it actually functions as a "scrolldown panel".

### [welcome.blade.php](file:///c:/Users/Prinz%20Tsabio/Herd/e-library2/task-app/resources/views/welcome.blade.php)
- Shrink logo in the sticky nav to match (`w-9 h-9`, `text-xl`).
- Reduce the `py-4` padding of the nav on scroll to `py-2.5` for a slimmer feel.

### [layouts/guest.blade.php](file:///c:/Users/Prinz%20Tsabio/Herd/e-library2/task-app/resources/views/layouts/guest.blade.php)
- Shrink the logo from `w-20 h-20` to `w-14 h-14` to keep it consistent with the new minimalist direction.
- Adjust text size accordingly.

## Verification Plan
### Manual Verification
- Verify that the navigation in the dashboard is now sticky and looks slimmer.
- Check the Welcome page scroll behavior to ensure the nav transitions to a slim state correctly.
- Ensure the logo on the login/register pages feels more balanced.
