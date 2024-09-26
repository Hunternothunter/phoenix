<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function recommendUsers($currentUser, $allUsers)
    {
        $recommendations = [];

        // Ensure following and interests are arrays
        $currentUserFollowing = is_array($currentUser->following) ? $currentUser->following : [];
        $currentUserInterests = is_array($currentUser->interests) ? $currentUser->interests : [];

        foreach ($allUsers as $user) {
            if ($user->id === $currentUser->id) continue;

            // Ensure user properties are arrays
            $userFollowing = is_array($user->following) ? $user->following : [];
            $userInterests = is_array($user->interests) ? $user->interests : [];

            $score = 0;

            // Mutual Following
            $mutualFollowing = count(array_intersect($currentUserFollowing, $userFollowing));
            $score += $mutualFollowing * 2; // Weighting

            // Interests
            $interestMatches = count(array_intersect($currentUserInterests, $userInterests));
            $score += $interestMatches * 3; // Higher weight for interests

            // Location (use the method from this class)
            if ($this->calculateDistance($currentUser->location, $user->location) < 50) {
                $score += 5; // Nearby users get a bonus
            }

            // Engagement Levels (use the method from this class)
            $engagementScore = $this->calculateEngagementScore($currentUser, $user);
            $score += $engagementScore;

            $recommendations[$user->id] = $score;
        }

        // Sort recommendations by score
        arsort($recommendations);

        return array_keys(array_slice($recommendations, 0, 5, true)); // Top 5
    }

    public function calculateDistance($location1, $location2)
    {
        // Implement your distance calculation logic here
        // Placeholder example:
        return 0; // Replace with actual distance logic
    }

    public function calculateEngagementScore($currentUser, $user)
    {
        // Implement your engagement score logic here
        // Placeholder example:
        return 0; // Replace with actual engagement score logic
    }
}
